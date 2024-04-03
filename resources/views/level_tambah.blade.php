@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="card card-warning">
    <div class="card-header bg-primary">
        <h3 class="card-title">Tambah Level</h3>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <form method="POST" action="{{ route('level.tambah_simpan') }}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="form-group">
                        <label>Level</label>
                        <input type="number" class="form-control" placeholder="Enter" name="level_id">
                    </div>
                    <div class="form-group">
                        <label>Level Kode</label>
                        <input type="text" class="form-control" placeholder="Enter" name="level_nama">
                    </div>
                    <div class="form-group">
                        <label>Level Nama</label>
                        <input type="text" class="form-control" placeholder="Enter" name="level_kode">
                    </div>
                    
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


{{-- Tampilkan pesan kesalahan validasi --}}
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