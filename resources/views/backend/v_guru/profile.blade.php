@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form enctype="multipart/form-data"
                    action="{{ url('guru/profile/store/' . $guru->id) }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Lengkapi Profile {{ $guru->name }}</h4>

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="name" disabled value="{{ old('name', $guru->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Name Siswa">
                        </div>

                        <div class="form-group">
                            <label>No Induk Guru</label>
                            <input type="text" name="no_induk" disabled value="{{ old('no_induk', $guru->no_induk) }}"
                                class="form-control @error('no_induk') is-invalid @enderror"
                                placeholder="Masukkan no_induk Guru">
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat"
                                value="{{ old('alamat', optional($profile)->alamat ?? '') }}"
                                class="form-control" placeholder="Masukkan Alamat Lengkap">
                        </div>

                        <!-- Foto Guru -->
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        @if($profile && !is_null($profile->image))
                        <img width="20%" src="{{ asset('storage/guru/' . $profile->image ) }}" alt="homepage"
                            class="light-logo mb-1 mt-2 rounded" />
                        @else

                        @endif

                        <!-- Jabatan -->
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan"
                                value="{{ old('jabatan', optional($profile)->jabatan ?? '') }}" class="form-control"
                                placeholder="Masukkan Jabatan Guru">
                        </div>

                        <!-- No Telepon -->
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp"
                                value="{{ old('no_tlp', optional($profile)->no_tlp ?? '') }}" class="form-control"
                                placeholder="Masukkan No Telepon">
                        </div>

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success text-white">
                                Simpan
                            </button>
                            <a href="{{ url('guru') }}">
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
