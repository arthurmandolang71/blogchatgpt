@extends('layouts.main')

@section('container')
<main class="form-signin w-100 m-auto">
    <form action="/register" method="post">
      @csrf
      <h1 class="h3 mb-3 fw-normal">Registration</h1>
  
      <div class="form-floating">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="" value="{{ old('name')
         }}">
        <label for="floatingInput">Nama</label>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="" value="{{ old('username')
      }}">
        <label for="floatingInput">Username</label>
        @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email')
      }}">
        <label for="floatingInput">Email address</label>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
  
   
      <button class="w-100 btn btn-lg btn-primary" type="submit">Registrasi</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
   
</main>
@endsection
