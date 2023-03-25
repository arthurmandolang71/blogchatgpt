@extends('layouts.main')

@section('container')
    
<h1>Halaman About</h1>
<h3>Nama    : {{ $name }} </h3>
<p>email : {{ $email }} </p>
<img src="images/{{ $images }}" alt="">
            
@endsection
