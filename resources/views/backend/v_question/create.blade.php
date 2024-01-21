@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <body>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="d-flex justify-content-between m-2">
                        <div>
                            <h4 class="card-title">{{ $sub }}</h4>
                        <div class="form-group">
                            <span type="text" value="{{$question->id}}" name="category_id" class="badge badge-success">{{$question->name}}</span> <span type="text"  class="badge badge-info">sudah {{$listQuestion->count()}} soal yang dibuat</span>
                        </div>
                        </div>
                        <div>
                            <button id="btnCreateQuestion" class="btn btn-success">Buat Pertanyaan</button>
                        </div>
                    </div>
                    <form id="createQuestionForm"  style="display: none;" action="{{ url('question/store/' .$question->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Question Image</label>
                                <input type="file" name="image" id="image" class="form-control" onchange="previewFoto()">
                            </div>

                            <img id="imagePreview" class="foto-preview mb-2" style="display: none; width: 30%;" alt="Image Preview">

                            <div class="form-group">
                                <label for="content">Question</label>
                                <textarea name="content" id="editor" class="form-control" rows="4" placeholder="Enter the question content">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            @for ($i = 'A'; $i <= 'E'; $i++)
                                <div class="form-group">
                                    <label for="option_{{ strtolower($i) }}">Option {{ $i }}</label>
                                    <input type="text" name="option_{{ strtolower($i) }}" id="option_{{ strtolower($i) }}" class="form-control"
                                        placeholder="Option {{ $i }}" value="{{ old('option_' . strtolower($i)) }}">
                                </div>
                            @endfor
                            <div class="form-group">
                                <label for="correct_option">Correct Option</label>
                                <select name="correct_option" id="correct_option" class="form-control">
                                    @for ($i = 'A'; $i <= 'E'; $i++)
                                        <option value="{{ $i }}" {{ old('correct_option') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Question Image</th>
                                    <th class="px-5" >Question Text</th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                    <th>Status</th>
                                    <th>Correct</th>
                                    <th>Aksi</th>
                                </tr>
                            <tbody>
                                @foreach ($listQuestion as $index => $row)
                                <tr>
                                    <td align="center">{{ $index + 1 }}</td>
                                    <td align="center"> <img width="40px" src="{{asset('storage/question/'.$row->image)}}" alt=""> </td>
                                    <td align="center"> {{$row->content}} </td>
                                    <td align="center"> {{$row->option_a}} </td>
                                    <td align="center"> {{$row->option_b}} </td>
                                    <td align="center"> {{$row->option_c}} </td>
                                    <td align="center"> {{$row->option_d}} </td>
                                    <td align="center"> {{$row->option_e}} </td>
                                    <td>
                                        @if ($row->status == 1)
                                            <a href="/question/draft/{{ $row->id }}"><span
                                                    class="badge badge-success">Publish</span></a>
                                        @else
                                            <a href="/question/publish/{{ $row->id }}"><span
                                                    class="badge badge-danger">Draft</span></a>
                                        @endif
                                    </td>
                                    <td align="center"> {{$row->correct_option}} </td>
                                    <td align="center">
                                        <a href="{{ url('question/edit', $row->id) }}" title="Ubah Data">
                                            <span class="btn btn-cyan btn-sm text-white"><i class="fa fa-edit"></i>Ubah</span>
                                        </a>
                                        <form class="m-1" method="POST" action="{{ url('question/destroy', $row->id) }}" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->nama }}"><i class="fa fa-trash"></i>Hapus</button></button>
                                        </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- template end-->
@endsection
