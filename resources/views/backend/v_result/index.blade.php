@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table-striped table-bordered table">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Pelajaran</th>
                                    <th>Pelaksanaan</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $index => $row)
                                <tr>
                                    <td align="center">{{ $index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->tanggal_pelaksanaan }}</td>
                                    <td>{{ $row->durasi }}</td>
                                    <td>
                                        @if ($row->status == 1)
                                            <a href="/categories/draft/{{ $row->id }}"><span class="badge badge-success">Publish</span></a>
                                        @else
                                            <a href="/categories/publish/{{ $row->id }}"><span class="badge badge-danger">Draft</span></a>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <a href="{{ url('result', $row->id) }}">
                                            <span class="btn btn-cyan btn-sm m-1 text-white">Lihat Pengumpulan Ujian Siswa</span>
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
