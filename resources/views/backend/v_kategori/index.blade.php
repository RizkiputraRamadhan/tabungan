@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $sub }} <br><br>
                        <a href="/categories/create" title="Tambah data">
                            <button type="button" class="btn btn-primary">Tambah</button>
                        </a>
                    </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table-striped table-bordered table">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Pelajaran</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
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
                                        <td> {{ $row->name }} </td>
                                        <td> {{ $row->jam_mulai }} </td>
                                        <td> {{ $row->jam_selesai }} </td>
                                        <td> {{ $row->tanggal_pelaksanaan }} </td>
                                        <td> {{ $row->durasi }} </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <a href="/categories/draft/{{ $row->id }}"><span
                                                        class="badge badge-success">Publish</span></a>
                                            @else
                                                <a href="/categories/publish/{{ $row->id }}"><span
                                                        class="badge badge-danger">Draft</span></a>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{ url('categories/edit', $row->id) }}" title="Ubah Data">
                                                <span class="btn btn-cyan btn-sm m-1 text-white"><i
                                                        class="fa fa-edit"></i>Ubah</span>
                                            </a>
                                            <form method="POST" action="{{ url('categories/destroy', $row->id) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm show_confirm m-1"
                                                    data-toggle="tooltip" title='Delete'
                                                    data-konf-delete="{{ $row->name. ' Dan Pertanyaan' }}"><i
                                                        class="fa fa-trash"></i>Hapus</button></button>
                                            </form>
                                            <a href="{{ url('question/create', $row->id) }}" title="Pertanyaan">
                                                <span class="btn btn-success btn-sm m-1 text-white"><i
                                                        class="fa fa-edit"></i>Buat Pertanyaan</span>
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
