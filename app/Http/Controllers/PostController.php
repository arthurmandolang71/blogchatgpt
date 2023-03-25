<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use PharIo\Manifest\Author;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class PostController extends Controller
{
    public function index()
    {
        $title = '';

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
            'title' => "All Post $title",
            'active' => 'Blog',
            "post" =>  Post::latest()->filter(request(['search','category','author']))->cursorPaginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('detailpost',[
            "title" => "Post detail",
            'active' => 'Blog',
            "post" => $post
        ]);
    }

    public function add()
    {
        $random_penulis = rand(2,6);
        $random_category = rand(1,10);

        $cateogry = Category::firstWhere('id', $random_category);

        $minta_judul = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "carikan saya satu judul artikel bagaimana $cateogry->name",
            'max_tokens' => 50,
        ]);
        $answer_judul = $minta_judul['choices'][0]['text'];
    
        $minta_artikel = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "carikan saya artikel panjang dan menarik yang berjudul: ". $answer_judul. " .ada kesimpulan. maksimalkan dengan tag html h2, h3 , li, p. ada link-link website utama terkait dengan target blank. ",
            'max_tokens' => 3500,
            'temperature' => 0.3,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0
        ]);
        $answer_artikel = $minta_artikel['choices'][0]['text'];

        $minta_keyword = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan keyword seo dari: ". $answer_artikel,
            'max_tokens' => 75,
        ]);
        $answer_keyword = $minta_keyword['choices'][0]['text'];

        $minta_description = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan deskripsi seo dari: ". $answer_artikel,
            'max_tokens' => 100,
        ]);
        $answer_description = $minta_description['choices'][0]['text'];

        $minta_hashtag = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "ambilkan hastag seo dari: ". $answer_artikel,
            'max_tokens' => 75,
        ]);
        $answer_hashtag = $minta_hashtag['choices'][0]['text'];

        $slug = Str::slug($answer_judul, '-');
       
        Post::create([
            'category_id' => $cateogry->id,
            'user_id' => $random_penulis,
            'title' =>  $answer_judul,
            'slug' =>  $slug,
            'keyword' => $answer_keyword,
            'description' => $answer_description,
            'hastag' => $answer_hashtag,
            'body' => $answer_artikel,
        ]);

        echo "berhasil di tambahkan : $answer_judul <br>";
      
       
    }
}
