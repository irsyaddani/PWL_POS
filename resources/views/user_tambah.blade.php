{{-- <body>
    <h1>Form Tambah Data User</h1>
    <a href="{{route('/user')}}">Kembali</a>
    <form action="{{ route('/user/tambah_simpan') }}" method="post">
        {{ csrf_field() }}
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">
        <br>
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password">
        <br>
        <label>Level ID</label>
        <input type="number" name="level_id">
        <br>
        <input type="submit" class="btn btn-success" value="Simpan">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                    </div>
        @endif
    </form>
</body>  --}}

@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="card card-warning">
    <div class="card-header bg-primary">
        <h3 class="card-title">Tambah User</h3>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <form method="POST" action="{{ route('user.tambah_simpan') }}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="level_id">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@endsection