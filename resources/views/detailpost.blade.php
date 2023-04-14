
@extends('layouts.main')

@section('container')

    <?php
        $ambil_keyowrd = explode(" ",$post->keyword);
        $gambar_1 = $ambil_keyowrd[0];
        // $gambar_2 = $ambil_keyowrd[1];
        // print_r($gambar_1); exit();
    ?>

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                {{-- <h1 class="mb-3">{{ $post->title }}</h1> --}}
      
                    <img src="https://source.unsplash.com/1200x400/?{{ $gambar_1 }}" class="card-img-top" alt="{{ $gambar_1 }}">

                    <p> By. <a href="/blog?category={{ $post->author->username  }}" > {{ $post->author->name }} </a> | Category : <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a> </p>

                    <article class="my-3 fs-5"> {!! $post->body !!} </article>

                    {{-- <img src="https://source.unsplash.com/1200x400/?{{ $gambar_1 }}" class="card-img-top" alt="{{ $gambar_1 }}"> --}}

                    {{-- <article class="my-3 fs-5"> {!! $post->kesimpulan !!} </article> --}}

                    <article class="my-3 fs-5"> {{ $post->hastag }} </article>
                
                <h4>Baca Juga : </h4>
                <ul>
                    @foreach ($artikel_lain as $item)
                        <li>
                            <a href="{{ $item->slug }}">{{ str_replace('"','',$item->title )}}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="/blog">kembali</a >
            </div>
        </div>
    </div>
 
@endsection