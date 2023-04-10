@extends('dashboard.layouts.main')

@section('container')
    
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Keyword</h1>
    </div>

    <form action="/baca/dashboard/keyopenai" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <label for="formFile" class="form-label">key Open AI</label>
            <input class="form-control" type="text"  name="key" >
        </div>
        <div class="col-md-2">
            <br>
            <button type="submit" class="btn btn-primary">tambah</button>
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
              <th scope="col">Key Open AI</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($keyword as $item)    
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->key }}</td>
                    {{-- <td>{{ $item->status }}</td> --}}
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    </div>
  </main>

@endsection