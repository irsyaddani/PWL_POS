@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat kategori baru</h3>
            </div>

            <form action="../kategori" method="post">
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" class="form-control" name="kodeKategori" id="kodeKategori"> --}}
                        
                        <label for="kategori_kode">Kategori Kode</label>
                        <input 
                        id="kategori_id" 
                        type="text" 
                        name="kategori_kode" 
                        class="@error('kategori_kode') is-invalid @enderror">

                        @error('kategori_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="namaKategori" id="namaKategori">
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="../kategori" class="btn btn-primary">Kembali</a>
                </div>
        </div>
    </div>
@endsection