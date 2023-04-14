<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->view('sitemap', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }

    public function page() {
      
        return response()->view('sitemap_page', [
          
        ])->header('Content-Type', 'text/xml');
    }

}
