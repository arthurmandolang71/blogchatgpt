<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $tabel = 'categories';

    protected $guarded = ['id'];

    public function post() 
    {
        return $this->hasMany(Post::class);
    }

    public function keyword() 
    {
        return $this->hasMany(Keyword::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
