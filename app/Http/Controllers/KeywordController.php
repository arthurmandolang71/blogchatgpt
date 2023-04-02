<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Category;

class KeywordController extends Controller
{
    public function index()
    {
        
        return view('dashboard.keyword.index',[
            'title' => "keyword",
            'keyword' => Keyword::latest()->get(),
            'category' => Category::all(),
        ]);
        
    }

    public function store(Request $request)
    {
        $file = $request->file('file_csv')->getPathName();
        

        $data =  array_map('str_getcsv', file($file));

        unset($data[0]);

        for ($i = 1; $i <= count($data); $i++){

            $keyword[] = array( 
                'name'	=>	$data[$i][0],
                'category_id'	=>	$request->input('category_id'),
                'status'		=>	0,
            );
        }

        foreach (array_chunk($keyword,10) as $item)  
        {
             Keyword::insertOrIgnore($item);
        }

        return redirect('/baca/dashboard/keyword')->with('pesan','keyword berhasil di upload'); 

    }

}
