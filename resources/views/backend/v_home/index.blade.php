@extends('backend.v_layouts.app')
@section('content')
<!-- template -->
@if ( auth()->user()->typeuser == 1 )
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$sub}}</h5>
                <div class="table-responsive">
                    Selamat datang hi, <b>{{ auth()->user()->nama }}</b>
                    <p class="mt-2">

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (auth()->user()->typeuser == 2 )
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form enctype="multipart/form-data"
                action="/guru/profile/store/{{ auth()->user()->id }}" method="post" class="form-horizontal">
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
                            value="{{ old('alamat', optional($profileGuru)->alamat ?? '') }}"
                            class="form-control" placeholder="Masukkan Alamat Lengkap">
                    </div>

                    <!-- Foto Guru -->
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    @if($profileGuru && !is_null($profileGuru->image))
                    <img width="20%" src="{{ asset('storage/guru/' . $profileGuru->image ) }}" alt="homepage"
                        class="light-logo mb-1 mt-2 rounded" />
                    @else

                    @endif

                    <!-- Jabatan -->
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan"
                            value="{{ old('jabatan', optional($profileGuru)->jabatan ?? '') }}" class="form-control"
                            placeholder="Masukkan Jabatan Guru">
                    </div>

                    <!-- No Telepon -->
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_tlp"
                            value="{{ old('no_tlp', optional($profileGuru)->no_tlp ?? '') }}" class="form-control"
                            placeholder="Masukkan No Telepon">
                    </div>

                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Saldo Tabungan</h5>
                        <hr>
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h3 class="text-white">Rp. {{ number_format($sumSaldoAll->saldo, 0, ',', ',') }}</h3>
                                <h6 class="text-white">Jumlah Keseluruhan Saldo</h6>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title m-b-0">Activite Saving</h4>
                    <div class="m-t-20">
                        <div class="d-flex no-block align-items-center">
                            <span>{{ $debit->count() }}x Debit</span>
                            <div class="ml-auto">
                                <span>Rp. {{ number_format($sumSaldoDebit, 0, ',', ',') }}</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                style="width: {{ $debit->count() }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex no-block align-items-center m-t-25">
                            <span>{{ $kredit->count() }}x Kredit</span>
                            <div class="ml-auto">
                                <span>Rp. {{ number_format($sumSaldoKredit, 0, ',', ',') }}</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                style="width: {{ $kredit->count() }}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Pengumuman</h5>
                <hr>
                <div class="table-responsive">
                    Selamat datang hi, <b>{{ auth()->user()->name }}</b>
                    <p class="mt-2">
                       <b>Peraturan Ujian :</b>
                       <p>
                        1. Peserta tidak boleh meninggalkan ujian ketika sudah memulai ujian. <br>
                        2. Peserta memasuki ujian tepat pada waktunya. <br>
                        3. Peserta tidak boleh menengok kanan kiri atau bertanya kepada temannya. <br>
                        4. Peserta tidak boleh membuka tab baru pada browser dan membuka aplikasi lain selain halaman ujian. <br>
                        5. Jika Peserta melanggar pasal 1 dan 4 maka secara otomatis ujian <b>GAGAL/KELUAR UJIAN DENGAN SENDIRINYA.</b>. <br>

                       </p>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <b>Identitas {{ auth()->user()->name }}</b>
                </h5>
                <div class="table-responsive">
                    <form action="/siswa/profile/store/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input disabled type="text" name="name" value="{{ auth()->user()->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap">
                                @error('name')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>No Induk Siswa</label>
                                <input type="text" name="no_induk" disabled value="{{ auth()->user()->no_induk }}"
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

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- template end-->
@endif

@endsection
