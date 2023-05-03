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
        $title = 'Bacaan Hari ini';

        if(request('category')) {
            $category = Category::firstWhere('slug',request('category'));
            $title = "Tulisan pada kategori $category->name";
        }; 

        if(request('author')) {
            $author = User::firstWhere('username',request('author'));
            $title = "Tulisan Pada Penulis $author->name";
        }; 
       
        return view('post', [
            'author' => '',
            'title' => "$title",
            'description' => 'inditekno',
            'keyword' => 'news',
            'active' => 'Blog',
            "post" =>  Post::latest()->filter(request(['search','category','author']))->cursorPaginate(4)->withQueryString()
        ]);

    }

    public function show(Post $post, Request $request)
    {
    
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
                    'prompt' => 'hallo',
            ]);
        } catch (Throwable $e) {
           
            if($e){
                 Key::destroy($key->id);
                return false;
            }
        }

        // dd('test');
        $random_penulis = rand(2,6);
        $keyword = Keyword::inRandomOrder()->where('status',0)->first();

        $minta_judul =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "berikan saya judul artikel tentang $keyword->name dalam bahasa indonesia tanpa tanda petik dan tanpa /n",
            'max_tokens' => 50,
        ]); $answer_judul = $minta_judul['choices'][0]['text'];

       

        $minta_artikel =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Saya mempunyai blog yang sudah rangking 1 google. Tulislah sebuah artikel dengan judul '$answer_judul' dalam bahasa Indonesia yang santai. Artikel tersebut terdiri dari minimal 20 paragraf dan di awali dengan daftar isi sudah pendahuluan. Setiap paragraf harus memiliki  300 kata. Sapa pembaca dengan 'Hello' dengan nama audiens 'IndiTekno' pada paragraf pertama bukan di dalam judul!.  Tulislah artikel dalam format HTML tanpa tag html dan body. Judul utama: <h1>. Sub judul: <h2>. Judul kesimpulan: <h3>. Paragraf: <p>. dan di akhir artikel ucapkan sampai jumpa kembali di artikel menarik lainnya. ",
            'max_tokens' => 1700,
            'temperature' => 0.3,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0
        ]); $answer_artikel = $minta_artikel['choices'][0]['text'];

        //  return $answer_artikel;
        
        $minta_keyword =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan 2 kata terkait dari judul ". $answer_judul . "pisahkan dengan koma",
            'max_tokens' => 75,
        ]); $answer_keyword = $minta_keyword['choices'][0]['text'];

        $minta_description =  $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan deskripsi seo dari judul artikel ". $answer_judul,
            'max_tokens' => 100,
        ]); $answer_description = $minta_description['choices'][0]['text'];

        $slug = Str::slug($answer_judul, '-');
       
        Post::create([
            'category_id' => $keyword->category_id,
            'keyword_id' => $keyword->id,
            'user_id' => $random_penulis,
            'title' =>  str_replace("Judul Artikel:","",$answer_judul),
            'slug' =>  $slug,
            'keyword' => str_replace("Keyword SEO","",$answer_keyword),
            'description' => str_replace("Deskripsi SEO:","",$answer_description),
            // 'hastag' => $answer_hashtag,
            'body' => $answer_artikel,
            'kesimpulan' => '',
        ]);

        Keyword::where('id', $keyword->id)->update(['status' => 1]);

        return redirect('/');
       
    }
}
