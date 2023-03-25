
@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>
                    <p> By. <a href="/blog?category={{ $post->author->username  }}" > {{ $post->author->name }} </a> | Category : <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a> </p>

                    <img src="https://source.unsplash.com/1200x400/?people" class="card-img-top" alt="technolgy">

                    <article class="my-3 fs-5"> {!! $post->body !!} </article>

                    {{!! $post->link_terkait  }}
                   
                <a href="/blog">kembali</a >
            </div>
        </div>
    </div>
 
@endsection