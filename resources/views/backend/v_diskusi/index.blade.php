@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->
    @php
        use Carbon\Carbon;
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ruang Diskusi Siswa Dengan Guru.</h5>
                    <div class="table-responsive">
                        Selamat datang hi, <b>{{ auth()->user()->name }}</b> diruang diskusi.
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="chat-box scrollable" style="height:475px;">
                        <ul class="chat-list p-3">
                            <!--chat Right -->
                            @foreach ($diskusi as $diskusi)
                                @if ($diskusi->users_id == auth()->user()->id)
                                    <!--chat left -->
                                    <li class="odd chat-item">
                                        <div class="chat-content">
                                            <div class="box bg-light-inverse">{{ $diskusi->text }}</div>
                                            <br>
                                        </div>
                                        <div class="chat-time">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $diskusi->created_at)->format('d F Y H:i:s') }}
                                        </div>
                                    </li>
                                @else
                                 <!--chat right -->
                                    <li class="chat-item">
                                        @if ($diskusi->user->id == 1)
                                        <div class="chat-img"><img src="{{asset('storage/diskusi/admin.jpg')}}" alt="admin"></div>
                                        @else
                                        <div class="chat-img"><img src="{{asset('storage/diskusi/siswa.png')}}" alt="user"></div>
                                        @endif
                                        <div class="chat-content">
                                            <h6 class="font-medium">{{ $diskusi->user->name }}</h6>
                                            <div class="box bg-light-info">{{ $diskusi->text }}</div>
                                        </div>
                                        <div class="chat-time">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $diskusi->created_at)->format('d F Y H:i:s') }}
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            <!--chat Row -->
                        </ul>
                    </div>
                </div>
                <form action="/diskusi" method="post">
                    @csrf
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-9">
                                <div class="input-field m-t-0 m-b-0">
                                    <textarea name="text" id="textarea1" placeholder="Type and enter" class="form-control border-0"></textarea>
                                </div>
                            </div>

                            <div class="col-3">
                                <button class="btn-circle btn-lg btn-cyan float-right border-0 text-white" type="submit"><i
                                        class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- template end-->
@endsection
