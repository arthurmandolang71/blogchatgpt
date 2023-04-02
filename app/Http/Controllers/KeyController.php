<?php

namespace App\Http\Controllers;


use App\Models\Key;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    public function index()
    {
        
        return view('dashboard.key.index',[
            'title' => "keyword",
            'keyword' => Key::latest()->get(),
          
        ]);
        
    }

    public function store(Request $request)
    {
        $item['key'] = $request->input('key');
    
        Key::insert($item);
        
        return redirect('baca/dashboard/keyopenai')->with('pesan','keyword berhasil di upload'); 

    }

}
