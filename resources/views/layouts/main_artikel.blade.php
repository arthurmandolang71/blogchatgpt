<?php
        $ambil_keyowrd = explode(" ",$post->keyword);
        $gambar_1 = $ambil_keyowrd[0];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trim($description ?? "" ) }}">
    <meta name="author" content="{{ $post->author->name }}" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ trim($post->title ?? "" ) }}" />
    <meta property="og:description" content="{{ trim($description ?? "" ) }}" />
    <meta property="og:url" content="{{ url('/') }}/{{ $post->slug }}" />
    <meta property="og:site_name" content="Inditekno.com" />
    <meta property="article:published_time" content="{{  $post->created_at->tz('UTC')->toAtomString() }}" />
    <meta property="article:modified_time" content="{{  $post->updated_at->tz('UTC')->toAtomString() }}" />
    <meta property="og:image" content="https://source.unsplash.com/1200x400/?{{ $gambar_1 }}" />
    <meta property="og:image:width" content="977" />
    <meta property="og:image:height" content="852" />
    <meta property="og:image:type" content="image/jpeg" />

    <title>{{ trim($title) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>

    @include('partials.navbar')

    <div class="container mt-4">
        @yield('container')
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>