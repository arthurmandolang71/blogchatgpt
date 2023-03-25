<?php

namespace App\Models;



class Post 
{
    private static $blog_post = [
        [
            "title" => "bertia terbaru",
            "slug" => "bertia-terbaru",
            "author" => "arthur",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, excepturi exercitationem rem neque recusandae ullam quo repellendus aspernatur. Totam quae reiciendis maxime blanditiis saepe possimus voluptatum labore perspiciatis dolorem perferendis!  "
        ],
        [
            "title" => "bertia kemarin",
            "slug" => "bertia-kemari",
            "author" => "arthur",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, excepturi exercitationem rem neque recusandae ullam quo repellendus aspernatur. Totam quae reiciendis maxime blanditiis saepe possimus voluptatum labore perspiciatis dolorem perferendis!  "
        ]
    ];

    public static function all() 
    { 
        return collect(self::$blog_post);
    }

    public static function find($slug)
    {
        $posts = static::all();

        return $posts->firstWhere('slug', $slug);

    }
}
