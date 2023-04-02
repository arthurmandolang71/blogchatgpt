@extends('dashboard.layouts.main')

@section('container')
    
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Keyword</h1>
    </div>

    <form action="/baca/dashboard/keyword" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4">
          <label for="exampleInputEmail1" class="form-label">Kategori</label>
          <select class="form-select form-select-lg mb-3" name="category_id" required>
              <option value="">Pilih Category</option>
              @foreach ($category as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-5">
            <label for="formFile" class="form-label">import keyword</label>
            <input class="form-control" type="file"  name="file_csv" >
        </div>
        <div class="col-md-3">
            <br>
            <button type="submit" class="btn btn-primary">Export</button>
        </div>
    </div>
    </form>
    <br>
    
    @if (session()->has('pesan'))
      <div class="alert alert-success" role="alert">
        {{ session('pesan') }}
      </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category</th>
              <th scope="col">Keyword</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($keyword as $item)    
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    </div>
  </main>

@endsection