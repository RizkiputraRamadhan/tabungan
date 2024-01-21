@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 type="text" class="badge badge-success card-title">{{$sub}}</h5>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 type="text" class="card-title">Akun {{$sub}}</h5>
                        <hr>
                        <div class="ml-3">
                            <p>Nama : {{ $guru->name }}</p>
                            <p>Email : {{ $guru->email }}</p>
                            <p>No Induk : {{ $guru->no_induk }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 type="text" class="card-title">Profil {{$sub}}</h5>
                        <hr>
                        @if(!$profil)
                         <h5 type="text" class="badge badge-danger card-title"> belum melengkapi data</h5>
                        @else
                        <div class="ml-3">
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img class="rounded-lg" width=" 200px" src="{{ asset('storage/guru/'.$profil->image)}}" alt="user" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Jabatan : {{ $profil->jabatan }}</p>
                            <p>Alamat : {{ $profil->alamat }}</p>
                            <p>No Tlp : {{ $profil->no_tlp }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- template end-->
@endsection
