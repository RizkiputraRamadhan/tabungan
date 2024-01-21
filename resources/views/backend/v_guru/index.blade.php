@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $sub }} <br><br>
                        <button id="btnCreateQuestion" type="button" class="btn btn-primary">Tambah</button>
                    </h5>
                    <div class="card">
                        <form id="createQuestionForm" style="display: none;" action="guru/store" method="post"
                            class="form-horizontal">
                            @csrf

                            <div class="card-body">
                                <h4 class="card-title">Tambah Akun Guru</h4>

                                <div class="form-group">
                                    <label>Nama Guru <span class="font-10 text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan Nama Guru">
                                    @error('name')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>No Induk Guru <span class="font-10 text-danger">*</span></label>
                                    <input type="text" name="no_induk" value="{{ old('no_induk') }}"
                                        class="form-control @error('no_induk') is-invalid @enderror"
                                        placeholder="Masukkan No Induk Guru">
                                    @error('no_induk')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email <span class="font-10 text-danger">( optional )</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan Email">
                                    @error('email')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label>Status</label>
                                    <input type="text" name="typeuser" value="2"
                                        class="form-control @error('typeuser') is-invalid @enderror"
                                        placeholder="Masukkan typeuser">
                                    @error('typeuser')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password <span class="font-10 text-danger">* minimal 8 karakter</span></label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan Password">
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
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama Akun</th>
                                    <th>No Induk Guru</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            <tbody>
                                @foreach ($akun as $index => $row)
                                    <tr>
                                        <td align="center">{{ $index + 1 }}</td>
                                        <td> {{ $row->name }} </td>
                                        <td> {{ $row->no_induk }} </td>
                                        <td> {{ $row->email }} </td>
                                        <td align="center">
                                            @if (auth()->user()->typeuser == 1)
                                                <a class="m-1" href="{{ url('guru/edit', $row->id) }}" title="Ubah Data">
                                                    <span class="btn btn-cyan btn-sm text-white"><i
                                                            class="fa fa-edit"></i>Ubah</span>
                                                </a>
                                                <a href="{{ url('guru/profile', $row->id) }}" title="Lengkapi Data">
                                                    <span class="btn btn-info btn-sm text-white"><i class="fa fa-user"></i>
                                                        Lengkapi</span>
                                                </a>
                                                <a class="m-1" href="{{ url('guru/detail', $row->id) }}" title="Detail Data">
                                                    <span class="btn btn-success btn-sm text-white"><i
                                                            class="fa fa-edit"></i>Detail</span>
                                                </a>
                                                <form method="POST" action="{{ url('guru/destroy', $row->id) }}"
                                                    style="display: inline-block;">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger btn-sm show_confirm"
                                                        data-toggle="tooltip" title='Delete'
                                                        data-konf-delete="{{ $row->nama_akun }}"><i
                                                            class="fa fa-trash"></i>Hapus</button></button>
                                                </form>
                                            @else
                                                <a href="{{ url('guru/detail', $row->id) }}" title="Detail Data">
                                                    <span class="btn btn-success btn-sm text-white"><i
                                                            class="fa fa-edit"></i>Detail</span>
                                                </a>
                                            @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- template end-->
@endsection
