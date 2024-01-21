@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 type="text" class="badge badge-success card-title">{{ $sub }}</h5>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 type="text" class="card-title">Akun {{ $sub }}</h5>
                            <hr>
                            <div class="ml-3">
                                <p>Name : {{ $siswa->name }}</p>
                                <p>Email : {{ $siswa->email }}</p>
                                <p>No Induk : {{ $siswa->no_induk }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 type="text" class="card-title">Profil {{ $sub }}</h5>
                            <hr>
                            @if (!$profil)
                                <h5 type="text" class="badge badge-danger card-title"> belum melengkapi data</h5>
                            @else
                                <div class="ml-3">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="el-card-item">
                                                <div class="el-card-avatar el-overlay-1"> <img class="rounded-lg"
                                                        width=" 200px" src="{{ asset('storage/siswa/' . $profil->image) }}"
                                                        alt="user" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="mt-2">
                                            <b>NAMA :</b> {{ $profil->nama_siswa }}
                                        </p>
                                        <p class="mt-2">
                                            <b>KELAS :</b> {{ $profil->kelas }}
                                        </p>
                                        <p class="mt-2">
                                            <b>No Induk :</b> {{ $profil->nomer_induk }}
                                        </p>
                                        <p class="mt-2">
                                            <b>Kelamin :</b> {{ $profil->kelamin }}
                                        </p>
                                        <p class="mt-2">
                                            <b>TTGL :</b> {{ $profil->tempat_tanggal_lahir_siswa }}
                                        </p>
                                        <p class="mt-2">
                                            <b>Alamat :</b> {{ $profil->alamat_lengkap }}
                                        </p>
                                        <p class="mt-2">
                                            <b>Ibu :</b> {{ $profil->nama_ibu }}
                                        </p>
                                        <p class="mt-2">
                                            <b>Ayah :</b> {{ $profil->nama_ayah }}
                                        </p>
                                        <p class="mt-2">
                                            <b>No Tlp :</b> {{ $profil->no_tlp }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="el-card-item">
                                            <b class="my-2">Kartu Keluarga :</b>
                                            <div class="el-card-avatar el-overlay-1"> <img class="rounded-lg" width=" 500px"
                                                    src="{{ asset('storage/siswa/berkas/' . $profil->foto_kk) }}"
                                                    alt="user" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-body">
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
                            <h5 type="text" class="card-title">Histori Tabungan {{ $sub }}</h5>
                            <hr>
                            @if (!$histori)
                                <h5 type="text" class="badge badge-danger card-title"> belum ada data histori ujian</h5>
                            @else
                                <div class="ml-3">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table-striped table-bordered table">
                                            <thead>
                                                <tr align="center">
                                                    <th>No</th>
                                                    <th>Siswa</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                    <th>Authors</th>
                                                    <th>Dibuat</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            <tbody>
                                                @foreach ($histori as $index => $row)
                                                    <tr>
                                                        <td align="center">{{ $index + 1 }}</td>
                                                        <td> {{ $row->student->name }} </td>
                                                        <td class="text-success font-bold">{{ $row->jenis_transaksi == 1 ? number_format($row->saldo_transaksi, 0, ',', ',') : '' }}
                                                        </td>
                                                        <td class="text-danger font-bold">{{ $row->jenis_transaksi == 2 ? number_format($row->saldo_transaksi, 0, ',', ',') : '' }}
                                                        </td>
                                                        <td> {{ $row->teacher->name }} </td>
                                                        <td>{{ $row->updated_at->diffForHumans() }}</td>
                                                        <td> {{ $row->keterangan }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
