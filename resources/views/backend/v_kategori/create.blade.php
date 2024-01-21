@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ url('categories/store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            
                <div class="card-body">
                    <h4 class="card-title">{{ $sub }}</h4>
            
                    <div class="form-group">
                        <label>Pelajaran</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Kategori Pelajaran">
                        @error('name')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror">
                        @error('tanggal_pelaksanaan')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label>Mulai Ujian</label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="form-control @error('jam_mulai') is-invalid @enderror">
                        @error('jam_mulai')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label>Selesai Ujian</label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="form-control @error('jam_selesai') is-invalid @enderror">
                        @error('jam_selesai')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label>Durasi Ujian (dalam menit)</label>
                        <input type="number" name="durasi" value="{{ old('durasi') }}" class="form-control @error('durasi') is-invalid @enderror" placeholder="Masukkan Durasi Ujian">
                        @error('durasi')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                            Simpan
                        </button>
                        <a href="/categories">
                            <button type="button" class="btn btn-danger">
                                Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </form>                      
        </div>
    </div>
</div>

<!-- template end-->
@endsection