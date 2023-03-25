

@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>

    @foreach ($categories as $category)
      <ul>
        <li>
            <h2><a href="catagories/{{ $category->slug }}"> {{ $category->name }}</a></h2>
        </li>
      </ul>
    @endforeach
    
@endsection