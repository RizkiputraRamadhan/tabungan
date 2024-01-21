@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form enctype="multipart/form-data" id="updateSiswaForm"
                    action="{{ url('siswa/profile/store/' . $siswa->id) }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Lengkapi Profile {{ $siswa->name }}</h4>

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="name" disabled value="{{ old('name', $siswa->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Name Siswa">
                        </div>

                        <div class="form-group">
                            <label>No Induk Siswa</label>
                            <input type="text" name="no_induk" disabled value="{{ old('no_induk', $siswa->no_induk) }}"
                                class="form-control @error('no_induk') is-invalid @enderror"
                                placeholder="Masukkan no_induk Siswa">
                        </div>

                        <!-- Foto Siswa -->
                        <div class="form-group">
                            <label>Foto Siswa</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        @if($profile && !is_null($profile->image))
                        <img width="20%" src="{{ asset('storage/siswa/' . $profile->image ) }}" alt="homepage"
                            class="light-logo mb-1 mt-2 rounded" />
                        @else

                        @endif
                        <!-- Tempat Tanggal Lahir Siswa -->
                        <div class="form-group">
                            <label>Tempat Tanggal Lahir Siswa</label>
                            <input type="text" name="tempat_tanggal_lahir_siswa"
                                value="{{ old('tempat_tanggal_lahir_siswa', optional($profile)->tempat_tanggal_lahir_siswa ?? '') }}"
                                class="form-control" placeholder="Masukkan Tempat Tanggal Lahir Siswa">
                        </div>

                        <!-- Kelas -->
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas', optional($profile)->kelas ?? '') }}"
                                class="form-control" placeholder="Masukkan Kelas">
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <input type="text" name="alamat_lengkap"
                                value="{{ old('alamat_lengkap', optional($profile)->alamat_lengkap ?? '') }}"
                                class="form-control" placeholder="Masukkan Alamat Lengkap">
                        </div>

                        <!-- Nama Ibu -->
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu"
                                value="{{ old('nama_ibu', optional($profile)->nama_ibu ?? '') }}" class="form-control"
                                placeholder="Masukkan Nama Ibu">
                        </div>

                        <!-- Nama Ayah -->
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah"
                                value="{{ old('nama_ayah', optional($profile)->nama_ayah ?? '') }}" class="form-control"
                                placeholder="Masukkan Nama Ayah">
                        </div>

                        <!-- Foto KK (Kartu Keluarga) -->
                        <div class="form-group">
                            <label>Foto KK (Kartu Keluarga)</label>
                            <input type="file" name="foto_kk" class="form-control-file">
                        </div>

                        @if($profile && !is_null($profile->foto_kk))
                        <a href="#" id="floating-image-link"
                            data-image-src="{{ asset('storage/siswa/berkas/' . $profile->foto_kk ) }}">
                            <img width="20%" src="{{ asset('storage/siswa/berkas/' . $profile->foto_kk) }}"
                                alt="homepage" class="light-logo mb-1 mt-2 rounded" />
                        </a>

                        <div id="floating-image-container" class="floating-image-container">
                            <img id="floating-image" class="floating-image" src="" alt="Floating Image">
                        </div>
                        @else

                        @endif


                        <!-- No Telepon -->
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp"
                                value="{{ old('no_tlp', optional($profile)->no_tlp ?? '') }}" class="form-control"
                                placeholder="Masukkan No Telepon">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="kelamin" class="form-control">
                                <option value="L"
                                    {{ old('kelamin', optional($profile)->kelamin ?? '') === 'L' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="P"
                                    {{ old('kelamin', optional($profile)->kelamin ?? '') === 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                                <option value="N"
                                    {{ old('kelamin', optional($profile)->kelamin ?? '') === 'N' ? 'selected' : '' }}>
                                    Non-Biner</option>
                            </select>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success text-white">
                                Simpan
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
