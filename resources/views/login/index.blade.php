@extends('layouts.main')

@section('container')
<main class="form-signin w-100 m-auto">
    <form action="/baca/login" method="post">
      @csrf

      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      
      @if(session('pesan'))     
        <div class="alert alert-success" role="alert">
          {{ session('pesan') }}
        </div>
      @endif

      @if(session('pesan_error'))     
        <div class="alert alert-danger" role="alert">
          {{ session('pesan_error') }}
        </div>
      @endif

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
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" value="{{ old('password')
      }}">
        <label for="floatingPassword">Password</label>
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div> --}}

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </form>
    {{-- <small>belum punya akun ?<a href="/register">Registrasi Sekarang</a></small> --}}
</main>
@endsection
