

@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <hr>

    @if ($post->count())

    <?php
      $ambil_keyowrd = explode(",",$post[0]->keyword);
      $gambar = $ambil_keyowrd[0];
    ?>

    <div class="card mb-3">
        {{-- <img src="https://source.unsplash.com/1200x400/?{{ $post[0]->category->name  }}" class="card-img-top" alt="technolgy"> --}}
      <img src="https://source.unsplash.com/1200x400/?{{ trim($gambar) }}" class="card-img-top" alt="technolgy">
        <div class="card-body text-center">
          <h3 class="card-title"><a href="/blog/{{ $post[0]->slug  }}" class="text-decoration-none text-dark"> {{  str_replace('"','',$post[0]->title) }} </a></h3>
          <p>
              <small>
                    By. <a href="/?author={{ $post[0]->author->username  }}" > {{ $post[0]->author->name }} </a> | Category : <a href="/?category={{ $post[0]->category->slug }}">{{ $post[0]->category->name }}</a> {{ $post[0]->created_at->diffForHumans() }}
              </small>
          </p>

          {{-- <p class="card-text">{{ $post[0]->excerpt }}</p> --}}

          <a href="/blog/{{ $post[0]->slug  }}" class="text-decoration-none btn btn-primary">Read more ....</a>

        </div>

    </div>

    <div class="container">
        <div class="row">
            @foreach ($post->skip(1) as $data)
            <?php
              $ambil_keyowrd = explode(",",$data->keyword);
              $gambar = $ambil_keyowrd[0];
            ?>
            <div class="col-md-4">
                <div class="card" >
                    {{-- <a href="/catagories/{{ $data->category->slug }}"><div class="position-absolute px-3 py-2 bg bg-danger text-white">{{ $data->category->name }}</div></a> --}}
                    <img src="https://source.unsplash.com/500x400/?{{  trim($gambar)  }}" class="card-img-top" alt="technolgy">
                    <div class="card-body">
                      <h5 class="card-title "><a href="/blog/{{ $data->slug  }}" class="text-decoration-none text-black">{{  str_replace('"','',$data->title) }}</a></h5>
                      <p>
                        <small>
                              By. <a href="/?author={{ $data->author->username  }}" > {{ $data->author->name }} </a> | Category : <a href="/?category={{ $data->category->slug }}">{{ $data->category->name }}</a> {{ $data->created_at->diffForHumans() }}
                        </small>
                      </p>
                      {{-- <p class="card-text">{{ strip_tags(substr($data->body, 0, 100))  }}</p> --}}
                      <a href="/blog/{{ $data->slug  }}" class="btn btn-primary">Readmore.. </a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

  @else 
    <p class="text-center fs-4">No post found</p>
  @endif

  <br>
  {{ $post->links(); }}


@endsection