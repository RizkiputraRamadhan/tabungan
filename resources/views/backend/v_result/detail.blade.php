@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="badge badge-info">{{ $category->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="ml-3">
                            <div class="table-responsive">
                                <table id="zero_config" class="table-striped table-bordered table">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Soal Benar</th>
                                            <th>Soal Salah</th>
                                            <th>Jumlah Soal</th>
                                            <th>Keterangan</th>
                                            <th>Selesai Mengerjakan</th>
                                            <th>Detail</th>
                                        </tr>
                                    <tbody>
                                        @foreach ($result as $index => $row)
                                            <tr>
                                                <td align="center">{{ $index + 1 }}</td>
                                                <td> {{ $row->user->nama }} </td>
                                                <td>
                                                    @php
                                                        $siswa = $siswa->where('users_id', $row->user->id)->first();
                                                    @endphp
                                                    @if ($siswa)
                                                        {{ $siswa->kelas }}
                                                    @else
                                                        Profil belum lengkap
                                                    @endif
                                                </td>
                                                <td> {{ $row->true }} </td>
                                                <td> {{ $row->false }} </td>
                                                <td> {{ $row->false + $row->true }} </td>
                                                <td> {{ $row->cheat }} </td>
                                                <td> {{ $row->updated_at }} </td>
                                                <td><a href="/siswa/detail/{{ $row->user->id }}"><span
                                                            class="btn btn-cyan btn-sm m-1 text-white">Detail</span></a>
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
        </div>
    </div>
    <!-- template end-->
@endsection
