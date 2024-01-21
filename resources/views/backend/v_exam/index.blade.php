@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Ujian Siswa</h5>
                    <div class="table-responsive">
                        Selamat datang hi, <b>{{ auth()->user()->nama }}</b> dihalaman daftar ujian.
                        <p></p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table-striped table-bordered table">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Pelaksanaan</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Benar</th>
                                <th>Salah</th>
                                <th>Jumlah Soal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam as $index => $row)
                                @php
                                    $resultQuestion = $result->where('category_id', $row->id)
                                        ->where('users_id', auth()->user()->id)->first();
                                    $countQuestion = $questionCount->where('category_id', $row->id)->count();
                                    $correctCount = $resultQuestion ? $resultQuestion->true : 0;
                                    $incorrectCount = $resultQuestion ? $resultQuestion->false : 0;
                                @endphp
                                <tr>
                                    <td align="center">{{ $index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->jam_mulai }}</td>
                                    <td>{{ $row->jam_selesai }}</td>
                                    <td>{{ $row->tanggal_pelaksanaan }}</td>
                                    <td>{{ $row->durasi }}</td>
                                    <td>
                                        @if ($row->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Panding</span>
                                        @endif
                                    </td>
                                    <td>{{ $correctCount }}</td>
                                    <td>{{ $incorrectCount }}</td>
                                    <td>{{ $countQuestion }}</td>
                                    <td align="center">
                                        @if ($row->status == 1)
                                            @if ($resultQuestion)
                                                <button class="btn btn-secondary btn-sm m-1" disabled>
                                                    <i class="fa fa-edit"></i> Ujian Selesai
                                                </button>
                                            @else
                                                <a href="{{ url($row->token) }}" title="Pertanyaan">
                                                    <span class="btn btn-success btn-sm m-1 text-white">
                                                        <i class="fa fa-edit"></i> Mulai Ujian
                                                    </span>
                                                </a>
                                            @endif
                                        @else
                                            <span class="badge badge-danger">Panding</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- template end-->
@endsection
