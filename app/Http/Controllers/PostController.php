<?php

namespace App\Http\Controllers;


use OpenAI;
use Throwable;
use App\Models\Key;
use App\Models\Post;
use App\Models\User;
use App\Models\Keyword;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;




class PostController extends Controller
{
    public function index()
    {
        $title = 'blog';

        if(request('category')) {
            $category = Category::firstWhere('slug',request('category'));
            // dd(request('category'));
            $title = "in Category : $category->name";
        }; 

        if(request('author')) {
            $author = User::firstWhere('username',request('author'));
            $title = "in author : $author->name";
        }; 
       
        return view('post', [
            'author' => '',
            'title' => "All Post $title",
            'description' => 'sobat news',
            'keyword' => 'news',
            'active' => 'Blog',
            "post" =>  Post::latest()->filter(request(['search','category','author']))->cursorPaginate(4)->withQueryString()
        ]);
    }

    public function show(Post $post, Request $request)
    {
    //    dd($request->segment(0));
       if($request->segment(1) == NULL){
            return redirect('baca/blog');
       }

        $artikel_lain = Post::inRandomOrder()->where('category_id',$post->category_id)->limit(3)->get();
    //    dd($artikel_lain);
        return view('detailpost',[
            'author' => $post->author->name,
            "title" => $post->title,
            'description' => $post->description,
            'keyword' => $post->keyword,
            'active' => 'Blog',
            "post" => $post,
            "artikel_lain" => $artikel_lain
        ]);  
    }

    public function add()
    {
        $key = Key::inRandomOrder()->first();
       
        $client =  OpenAI::client($key->key);
      
        try {
            $client->completions()->create([
                    'model' => 'text-davinci-003',
                    'prompt' => 'teknologi adalah',
            ]);
        } catch (Throwable $e) {
           
            if($e){
                 Key::destroy($key->id);
                return false;
            }
        }

        $random_penulis = rand(2,6);
        $keyword = Keyword::inRandomOrder()->where('status',0)->first();

        $minta_judul =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "berikan saya judul artikel tentang $keyword->name dalam bahasa indonesia tanpa tanda petik",
            'max_tokens' => 50,
        ]);

        // return $minta_judul;
        $answer_judul = $minta_judul['choices'][0]['text'];

        $minta_artikel =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Saya ingin membuat sebuah artikel untuk tujuan SEO dan peringkat di mesin pencari Google. Tulislah sebuah artikel dengan judul '$answer_judul' dalam bahasa Indonesia yang santai. Artikel tersebut terdiri dari minimal 20 paragraf. Setiap paragraf harus memiliki  300 kata. Sapa pembaca dengan 'Hello' dengan nama audiens 'Sobat NewsClub' pada paragraf pertama bukan di dalam judul!. Tulislah artikel dalam format HTML tanpa tag html dan body. Judul utama: <h1>. Sub judul: <h2>. Judul kesimpulan: <h3>. Paragraf: <p>. dan di akhir artikel ucapkan sampai jumpa kembali di artikel menarik lainnya. ",
            'max_tokens' => 2000,
            'temperature' => 0.3,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0
        ]);
        $answer_artikel = $minta_artikel['choices'][0]['text'];
        $artikel_non_html = strip_tags($answer_artikel);
    
        // $minta_kesimpulan =  $client->completions()->create([
        //     'model' => 'text-davinci-003',
        //     'prompt' => "buatkan kesimpulan dari artikel $artikel_non_html. ",
        //     'max_tokens' => 500,
        //     'temperature' => 0.3,
        //     'frequency_penalty' => 0.0,
        //     'presence_penalty' => 0.0
        // ]);
        // $answer_kesimpulan = $minta_kesimpulan['choices'][0]['text'];

        $minta_keyword =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan keyword seo in english 2 kata dari: ". $artikel_non_html . "pisahkan dengan koma",
            'max_tokens' => 75,
        ]);
        $answer_keyword = $minta_keyword['choices'][0]['text'];

        $minta_description =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan deskripsi seo dari: ". $artikel_non_html,
            'max_tokens' => 100,
        ]);
        $answer_description = $minta_description['choices'][0]['text'];

        $minta_hashtag =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan hastag seo dari: ". $artikel_non_html,
            'max_tokens' => 75,
        ]);
        $answer_hashtag = $minta_hashtag['choices'][0]['text'];

        $slug = Str::slug($answer_judul, '-');
       
        Post::create([
            'category_id' => $keyword->category_id,
            'keyword_id' => $keyword->id,
            'user_id' => $random_penulis,
            'title' =>  str_replace("Judul Artikel:","",$answer_judul),
            'slug' =>  $slug,
            'keyword' => str_replace("Keyword SEO","",$answer_keyword),
            'description' => str_replace("Deskripsi SEO:","",$answer_description),
            'hastag' => $answer_hashtag,
            'body' => $answer_artikel,
            'kesimpulan' => '',
        ]);

        Keyword::where('id', $keyword->id)->update(['status' => 1]);

        return redirect('/baca/blog');
       
    }
}
