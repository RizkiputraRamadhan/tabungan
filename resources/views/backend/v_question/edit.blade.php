@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<body>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="d-flex justify-content-between m-2">
                <div>
                    <h4 class="card-title">{{ $sub }}</h4>
                <div class="form-group">
                    <span type="text" value="{{$question->id}}" name="category_id" class="badge badge-success">{{$question->Categories->name}}</span> <span type="text"  class="badge badge-info">edit soal {{ $question->content }}</span>
                </div>
                </div>
            </div>
            <form action="{{ url('question/update/' .$question->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Question Image</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="previewFoto()">
                    </div>
                    <div class="d-flex">
                        @if ($question->image != null)
                        <img width="30%" src="{{asset('storage/question/'.$question->image)}}" alt="">
                        <span class="p-5">TO</span>
                        <img id="imagePreview" class="foto-preview mb-2" style="display: none; width: 30%;" alt="Image Preview">
                        @else
                        <img id="imagePreview" class="foto-preview mb-2" style="display: none; width: 30%;" alt="Image Preview">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content">Question</label>
                        <textarea name="content" id="editor" class="form-control" rows="4" placeholder="Enter the question content">{{ $question->content }}</textarea>
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
                                placeholder="Option {{ $i }}" value="{{$question->option_. strtolower($i)    }}">
                        </div>
                    @endfor
                    <div class="form-group">
                        <label for="correct_option">Correct Option</label>
                        <select name="correct_option" id="correct_option" class="form-control">
                            @for ($i = 'A'; $i <= 'E'; $i++)
                                <option value="{{ $i }}" {{$question->correct_option == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ url('question/create/'.$question->category_id) }}">
                        <button type="button" class="btn btn-danger">
                            Kembali
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<!-- template end-->
@endsection
