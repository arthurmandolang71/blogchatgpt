

@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <hr>

    @if ($post->count())

    <div class="card mb-3">
        <img src="https://source.unsplash.com/1200x400/?people" class="card-img-top" alt="technolgy">

        <div class="card-body text-center">
          <h3 class="card-title"><a href="/posts/{{ $post[0]->slug  }}" class="text-decoration-none text-dark"> {{ $post[0]->title }} </a></h3>

          <p>
              <small>
                    By. <a href="/blog?author={{ $post[0]->author->username  }}" > {{ $post[0]->author->name }} </a> | Category : <a href="/blog?category={{ $post[0]->category->slug }}">{{ $post[0]->category->name }}</a> {{ $post[0]->created_at->diffForHumans() }}
              </small>
          </p>

          {{-- <p class="card-text">{{ $post[0]->excerpt }}</p> --}}

          <a href="/posts/{{ $post[0]->slug  }}" class="text-decoration-none btn btn-primary">Read more ....</a>

        </div>

    </div>

   

    <div class="container">
        <div class="row">
            @foreach ($post->skip(1) as $data)
            <div class="col-md-4">
                <div class="card" >
                    {{-- <a href="/catagories/{{ $data->category->slug }}"><div class="position-absolute px-3 py-2 bg bg-danger text-white">{{ $data->category->name }}</div></a> --}}
                    {{-- <img src="https://source.unsplash.com/500x400/?art" class="card-img-top" alt="technolgy"> --}}
                    <div class="card-body">
                      <h5 class="card-title">{{ $data->title }}</h5>
                      <p>
                        <small>
                              By. <a href="/blog?author={{ $data->author->username  }}" > {{ $data->author->name }} </a> | Category : <a href="/blog?category={{ $data->category->slug }}">{{ $data->category->name }}</a> {{ $data->created_at->diffForHumans() }}
                        </small>
                      </p>
                      {{-- <p class="card-text">{{ $data->excerpt }}</p> --}}
                      <a href="/posts/{{ $data->slug  }}" class="btn btn-primary">Readmore.. </a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

  @else 
    <p class="text-center fs-4">No post found</p>
  @endif

  {{ $post->links(); }}


@endsection