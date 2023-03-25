@extends('dashboard.layouts.main')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Edit Data</h1>
    </div>   

    <form action="/dashboard/posts/{{ $post->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">judul</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" id="title" class="form-control  @error('title') is-invalid @enderror">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug)  }}" id="slug" class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori</label>
            <select class="form-select form-select-lg mb-3" name="category_id" >
                @foreach ($categories as $item)
                    @if(old('category_id', $post->category_id) == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('cataogry_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">edit gamber</label>
            @if($post->image)
                <img src='{{ asset("storage/$post->image") }}' class="img-preview img-fluid d-block">
            @else
                <img  class="img-preview img-fluid">
            @endif
            
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"  name="image" onchange="priviewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Post</label>
            <div class="form-floating">
                <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea">{{ old('body', $post->body ) }}</textarea>
                <label for="floatingTextarea">artikel</label>
                @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">update</button>
    </form>


</main>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })

    function priviewImage(){
        const image = document.querySelector('#image');
        const view = document.querySelector('.img-preview');

        view.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            view.src = oFREvent.target.result;
        }

    }


</script>
    
@endSection