

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/baca/blog">Sobat News!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between">
          {{-- <li class="nav-item">
            <a class="nav-link {{ ($active === "Home") ? 'active' : '' }}"  href="/">Home</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "dunia") ? 'active' : '' }}" href="/baca/blog?category=dunia" >Dunia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "indonesia") ? 'active' : '' }}" href="/baca/blog?category=indonesia" >Indoneisa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "teknologi") ? 'active' : '' }}" href="/baca/blog?category=teknologi" >Teknologi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "desain") ? 'active' : '' }}" href="/baca/blog?category=desain" >Desain</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "budaya") ? 'active' : '' }}" href="/baca/blog?category=budaya" >Budaya</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "bisnis") ? 'active' : '' }}" href="/baca/blog?category=bisnis" >Bisnis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "pendidikan") ? 'active' : '' }}" href="/baca/blog?category=pendidikan" >Pendidikan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "sains") ? 'active' : '' }}" href="/baca/blog?category=sains" >Sains</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "kesehatan") ? 'active' : '' }}" href="/baca/blog?category=kesehatan" >Kesehatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "wisata") ? 'active' : '' }}" href="/baca/blog?category=wisata" >Wisata</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->get('category') === "kontak") ? 'active' : '' }}" href="/baca/kontak" >Kontak</a>
          </li>
         
        
          {{-- <li class="nav-item">
            <a class="nav-link {{ ($active === "Catagories") ? 'active' : '' }}" href="/categories" >Category</a>
          </li> --}}
        </ul>
        <form class="d-flex" role="search" action="/baca/blog">
          @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request('search') }}" >
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        @auth
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li>
                <form action="/baca/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
        @else
          {{-- <a href="/login"><button class="btn btn-outline-primary" ><i class="bi bi-arrow-bar-right"></i>Login</button></a> --}}
        @endauth
        
      </div>
    </div>
  </nav>