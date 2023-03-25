
@extends('dashboard.layouts.main')

@section('container')
    
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
                <p> By. <a href="/blog?category={{ $post->author->username  }}" > {{ $post->author->name }} </a> | Category : <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a> </p>

                @if ($post->image)
                    <img src="{{ asset('storage/'. $post->image .'') }}" class="card-img-top" alt="technolgy">
                @else
                    <img src="https://source.unsplash.com/1200x400/?technolgy" class="card-img-top" alt="technolgy">
                @endif
              
                <article class="my-3 fs-5"> {!! $post->body !!} </article>
               
            <a href="/dashboard/posts">kembali</a >
        </div>
    </div>
</div>


@endsection