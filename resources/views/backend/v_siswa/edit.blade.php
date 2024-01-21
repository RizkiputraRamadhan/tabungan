@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form id="updateSiswaForm" action="{{ url('siswa/update/'.$siswa->id) }}" method="post" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Edit Akun {{ $siswa->nama }}</h4>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="name" value="{{ old('name', $siswa->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Name Siswa">
                        @error('name')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>No Induk Siswa</label>
                        <input type="text" name="no_induk" value="{{ old('no_induk', $siswa->no_induk) }}" class="form-control @error('no_induk') is-invalid @enderror" placeholder="Masukkan no_induk Siswa">
                        @error('no_induk')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $siswa->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                        @error('email')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                        @error('password')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                            Ubah
                        </button>
                        <a href="{{ url('siswa') }}">
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
