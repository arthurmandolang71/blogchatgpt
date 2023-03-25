@extends('dashboard.layouts.main')

@section('container')
    
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Post Category</h1>
    </div>
    <a href="/dashboard/categories/create" class="btn btn-primary">Tambah</a>
    @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)    
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="/dashboard/categories/{{ $category->slug }}">Detail</a><br>
                        <a href="/dashboard/categories/{{ $category->slug }}/edit">edit</a><br>
                        <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button type="submit" onclick="return confirm('yakin ?')">hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    </div>
  </main>

@endsection