@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->
    <style>
        .cursor:hover {
            cursor: pointer;
            background-color: #d3cccc;
        }

        #searchResults {
            display: none;

        }
    </style>
    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h3 class="text-white">Rp. {{ number_format($sumSaldoAll, 0, ',', ',') }}</h3>
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $sub }} <br><br>
                        <button id="btnCreateQuestion" type="button" class="btn btn-primary">Tambah</button>
                    </h5>
                    <div class="card">
                        <form id="createQuestionForm" style="display: none;" action="/saving" method="post"
                            class="form-horizontal">
                            @csrf

                            <div class="card-body">
                                <h4 class="card-title">Tambah Tabungan</h4>
                                <label>Nama Siswa <span class="font-10 text-danger">*</span></label>
                                <div class="input-group">

                                    <input type="text" id="searchStudent" value=""
                                        class="form-control @error('student_id') is-invalid @enderror"
                                        placeholder="Cari Nama Siswa" onclick="search">

                                    <input type="text" name="student_id" id="idStudent" value=""
                                        class="form-control d-none @error('student_id') is-invalid @enderror">

                                    @error('student_id')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cari
                                            Berdasarkan List</button>
                                        <div class="dropdown-menu cursor-pointer">
                                            @foreach ($studentId as $student)
                                                <option value="{{ $student->id }}"
                                                    class="dropdown-item cursor cursor-pointer" href="#"
                                                    onclick="selectStudent('{{ $student->id }}', '{{ $student->name }}')">
                                                    {{ $student->name }}</option>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <ul class="list-group mb-3 " id="searchResults">
                                    @foreach ($studentId as $student)
                                        <li class="cursor list-group-item bg-primary text-white text-bold"
                                            onclick="selectStudent('{{ $student->id }}', '{{ $student->name }}')">
                                            {{ $student->name }}</li>
                                    @endforeach
                                </ul>

                                <div class="form-group">
                                    <label>Jenis Transaksi <span class="font-10 text-danger">*</span></label>
                                    <select name="jenis_transaksi"
                                        class="form-control @error('jenis_transaksi') is-invalid @enderror">
                                        <option value="1" {{ old('jenis_transaksi') == 1 ? 'selected' : '' }}>Menabung
                                        </option>
                                        <option value="2" {{ old('jenis_transaksi') == 2 ? 'selected' : '' }}>Menarik
                                        </option>
                                    </select>
                                    @error('jenis_transaksi')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Saldo Transaksi<span class="font-10 text-danger">*</span></label>
                                    <input type="number" name="saldo_transaksi" value="{{ old('saldo_transaksi') }}"
                                        class="form-control @error('saldo_transaksi') is-invalid @enderror"
                                        placeholder="Masukkan saldo_transaksi">
                                    @error('saldo_transaksi')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
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
                                    <th>Siswa</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Authors</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            <tbody>
                                @foreach ($saving as $index => $row)
                                    <tr>
                                        <td align="center">{{ $index + 1 }}</td>
                                        <td> {{ $row->student->name }} </td>
                                        <td>{{ $row->jenis_transaksi == 1 ? number_format($row->saldo_transaksi, 0, ',', ',') : '' }}
                                        </td>
                                        <td>{{ $row->jenis_transaksi == 2 ? number_format($row->saldo_transaksi, 0, ',', ',') : '' }}
                                        </td>
                                        <td> {{ $row->teacher->name }} </td>
                                        <td>{{ $row->updated_at->diffForHumans() }}</td>
                                        <td align="center">
                                            <a href="{{ url('/siswa/detail', $row->student_id) }}" title="Detail Data">
                                                <span class="btn btn-success btn-sm text-white"><i
                                                        class="fa fa-edit"></i>Detail</span>
                                            </a>
                                        </td>
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
