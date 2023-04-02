<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Keyword;
use App\Models\Category;
use Illuminate\Support\Str;
use PharIo\Manifest\Author;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;




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
            "post" =>  Post::latest()->filter(request(['search','category','author']))->paginate(4)->withQueryString()
        ]);
    }

    public function show(Post $post, Request $request)
    {
    //    dd($request->segment(0));
    //    if($request->segment(0) == NULL){
    //         return redirect('baca/blog');
    //    }
  
        return view('detailpost',[
            'author' => $post->author->name,
            "title" => $post->title,
            'description' => $post->description,
            'keyword' => $post->keyword,
            'active' => 'Blog',
            "post" => $post
        ]);
    

       
    }

    private function setEnv($key)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            "OPENAI_API_KEY=''" ,
            "OPENAI_API_KEY='$key'" ,
            file_get_contents(app()->environmentFilePath())
        ));
    }



    public function add()
    {
       
        // env('OPENAI_API_KEY', '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');
        // $this->setEnv('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');


        $random_penulis = rand(2,6);
        $keyword = Keyword::inRandomOrder()->where('status',0)->first();
       
        $minta_judul = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "berikan saya judul artikel tentang $keyword->name dalam bahasa indonesia",
            'max_tokens' => 50,
        ]);

        // return $minta_judul;
        $answer_judul = $minta_judul['choices'][0]['text'];

        $minta_artikel = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Saya ingin membuat sebuah artikel untuk tujuan SEO dan peringkat di mesin pencari Google. Tulislah sebuah artikel dengan judul '$answer_judul' dalam bahasa Indonesia yang santai. Artikel tersebut terdiri dari minimal 20 paragraf. Setiap paragraf harus memiliki  300 kata. Sapa pembaca dengan 'Hello' dengan nama audiens 'Sobat NewsClub' pada paragraf pertama bukan di dalam judul!. Tulislah artikel dalam format HTML tanpa tag html dan body. Judul utama: <h1>. Sub judul: <h2>. Judul kesimpulan: <h3>. Paragraf: <p>. dan di akhir artikel ucapkan sampai jumpa kembali di artikel menarik lainnya. ",
            'max_tokens' => 2000,
            'temperature' => 0.3,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0
        ]);
        $answer_artikel = $minta_artikel['choices'][0]['text'];
        $artikel_non_html = strip_tags($answer_artikel);
    
        $minta_kesimpulan = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "buatkan kesimpulan dari artikel $artikel_non_html. ",
            'max_tokens' => 500,
            'temperature' => 0.3,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0
        ]);
        $answer_kesimpulan = $minta_kesimpulan['choices'][0]['text'];

        $minta_keyword = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan keyword seo in english 2 kata dari: ". $artikel_non_html . "pisahkan dengan koma",
            'max_tokens' => 75,
        ]);
        $answer_keyword = $minta_keyword['choices'][0]['text'];

        $minta_description = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan deskripsi seo dari: ". $artikel_non_html,
            'max_tokens' => 100,
        ]);
        $answer_description = $minta_description['choices'][0]['text'];

        $minta_hashtag = OpenAI::completions()->create([
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
            'kesimpulan' => $answer_kesimpulan,
        ]);

        Keyword::where('id', $keyword->id)->update(['status' => 1]);

        return redirect('/baca/blog');
       
    }
}
