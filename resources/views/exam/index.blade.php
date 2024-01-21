<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.1/dist/css/lightbox.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.1/dist/js/lightbox.min.js"></script>
    <title>Ujian Berlangsung</title>
</head>
<style>
    .floating-image-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        display: none;
    }

    .floating-image {
        max-width: 90%;
        max-height: 90%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blink-text {
        animation: blink 2s infinite;
    }
</style>

<body>
    <div class="h-screen">
        <nav class="border-dark:border-gray-600 start-0 top-0 z-20 w-full dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between">
                <div class="mt-0">
                    <div class="navbar bg-neutral text-white">
                        <div class="flex-1">
                            <img width="15%" src="{{ asset('storage/logo_sipenting.png') }}" alt="homepage"
                                class="light-logo" />
                        </div>
                        <div class="flex-none">
                            <div class="p-2">
                                <h4 class="font-medium">{{ auth()->user()->nama }}</h4>
                                <div class="flex">
                                    <button class="btn btn-success btn-xs ml-auto flex">Active </button>
                                </div>
                            </div>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                    <div class="w-10 rounded-full">
                                        <img alt="Tailwind CSS Navbar component"
                                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="min-h-25 bg-neutral navbar-fixed-top">
                        <div class="flex p-5 text-white">
                            <h2 class="border-l-2 p-2 font-semibold">{{ $exam->name }} <span
                                    class="ml-3 rounded-lg border p-2">{{ $exam->count() }}
                                    butir
                                    soal </span></h2>
                            <h2 id="dynamicDuration" class="ml-auto border-r-2 p-2 font-bold">{{ $exam->durasi }} </h2>
                            <span
                                class="blink-text blink-text badge badge-success mx-3 my-2 p-2 text-xs font-bold">Ujian
                                Berlangsung</span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Lopping -->
        <form action="/{{ $exam->token }}" method="POST">
            @csrf
            @foreach ($question as $question)
                <div class="border-b-2">
                    <div class="mt-5 px-5">
                        <div>
                            <h3 class="absolute font-bold">{{ $loop->iteration }}. </h3>
                            <div class="ml-5">
                                @if ($question->image)
                                    <a href="#" id="floating-image-link"
                                        data-image-src="{{ asset('storage/question/' . $question->image) }}">
                                        <img width="20%" src="{{ asset('storage/question/' . $question->image) }}"
                                            alt="homepage" class="light-logo mb-1 mt-2 rounded" />
                                    </a>

                                    <div id="floating-image-container" class="floating-image-container">
                                        <img id="floating-image" class="floating-image" src=""
                                            alt="Floating Image">
                                    </div>
                                @endif
                                <h5 class="">{{ $question->content }}</h5>

                                <div class="p-3">
                                    <ul class="question_options">
                                        <li>
                                            <input type="radio" name="id-{{ $question->id }}" class="radio"
                                                id="choice-{{ $loop->iteration }}-1" value="A" />
                                            <label for="choice-{{ $loop->iteration }}-1"
                                                class="ml-2">{{ $question->option_a }}</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="id-{{ $question->id }}" class="radio"
                                                id="choice-{{ $loop->iteration }}-2" value="B" />
                                            <label for="choice-{{ $loop->iteration }}-2"
                                                class="ml-2">{{ $question->option_b }}</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="id-{{ $question->id }}" class="radio"
                                                id="choice-{{ $loop->iteration }}-3" value="C" />
                                            <label for="choice-{{ $loop->iteration }}-3"
                                                class="ml-2">{{ $question->option_c }}</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="id-{{ $question->id }}" class="radio"
                                                id="choice-{{ $loop->iteration }}-4" value="D" />
                                            <label for="choice-{{ $loop->iteration }}-4"
                                                class="ml-2">{{ $question->option_d }}</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="id-{{ $question->id }}" class="radio"
                                                id="choice-{{ $loop->iteration }}-5" value="E" />
                                            <label for="choice-{{ $loop->iteration }}-5"
                                                class="ml-2">{{ $question->option_e }}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="question_ids[]" value="{{ $question->id }}">
                <input type="hidden" name="categories" value="{{ $exam->id }}">
            @endforeach
            <input type="hidden" name="cheat" id="cheatInput">
            @php
                $cheatMessage = request('cheat');
                // Now you can use $cheatMessage as needed in your PHP code
            @endphp
            <!-- akhir Lopping -->
            <div class="w-full px-5 py-8">
                <input id="selesaiButton" type="submit"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    value="SELESAI" />
            </div>
        </form>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let timerInterval;
    const dynamicDurationElement = document.getElementById('dynamicDuration');
    let durationInSeconds = parseInt(sessionStorage.getItem('duration')) || {{ $exam->durasi * 60 }};
    let timeoutId;

    function updateDuration() {
        const minutes = Math.floor(durationInSeconds / 60);
        const seconds = durationInSeconds % 60;
        const formattedDuration = `${minutes}:${seconds}`;
        dynamicDurationElement.textContent = formattedDuration;

        if (durationInSeconds > 0) {
            sessionStorage.setItem('duration', durationInSeconds);
            durationInSeconds--;
            timeoutId = setTimeout(updateDuration, 1000);
        } else {
            clearInterval(timerInterval);
            finishExam('Waktu Ujian Habis');
        }
    }

    // Check if the exam has already ended
    if (durationInSeconds > 0) {
        updateDuration();
    }

    function stopDuration() {
        clearTimeout(timeoutId);
    }

    function finishExam(message) {
        console.log('Cheat message:', message);
        sessionStorage.removeItem('duration');
        document.getElementById('cheatInput').value = message;
        document.getElementById('selesaiButton').click();
    }

    function curang() {
        var cek = document.getElementById('cheatInput');
        cek.value = 'Membuka Aplikasi lain';
        console.log(cek.value);
    }

    // Tampilkan gambar melayang
    document.addEventListener('DOMContentLoaded', function () {
        var floatingImageLink = document.getElementById('floating-image-link');
        var floatingImageContainer = document.getElementById('floating-image-container');
        var floatingImage = document.getElementById('floating-image');

        floatingImageLink.addEventListener('click', function (event) {
            event.preventDefault();
            var imageSrc = this.getAttribute('data-image-src');
            floatingImage.src = imageSrc;
            floatingImageContainer.style.display = 'block';
        });

        floatingImageContainer.addEventListener('click', function () {
            this.style.display = 'none';
        });
    });

    // SweetAlert2 Alerts
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Selesai!',
        text: "{{ session('success') }}"
    });
    @endif

    @if (session('error'))
    Swal.fire({
        icon: 'warning',
        title: 'Gagal !!.',
        text: "{{ session('error') }}"
    });
    @endif

    @if (session('errorToken'))
    Swal.fire({
        icon: 'warning',
        title: 'Ujian Sedang Berlangsung !!.',
        text: "{{ session('errorToken') }}"
    });
    @endif

    @if (session('errorStatus'))
    Swal.fire({
        icon: 'warning',
        title: 'Ujian Tidak Ditemukan !!.',
        text: "{{ session('errorStatus') }}"
    });
    @endif

    @if (session('ExplayedDate'))
    Swal.fire({
        icon: 'warning',
        title: 'Ujian Sudah Selesai !!.',
    });
    @endif

    // Handling Exam Violations
    let examEnded = false;

    window.addEventListener("blur", function () {
        if (!examEnded) {
            Swal.fire({
                title: " Melanggar Peraturan Ujian!",
                html: "Ujian tidak boleh membuka aplikasi lain. <br> Ujian Dinyatakan gagal !!.",
                timer: 11000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    finishExam('Membuka Aplikasi lain');
                }
            });
        }
    });

    window.addEventListener('keyup', (e) => {
        if (e.key == 'PrintScreen') {
            navigator.clipboard.writeText('');
            Swal.fire({
                title: " Melanggar Peraturan Ujian!",
                html: "Ujian tidak boleh membuka aplikasi lain. <br> Ujian Dinyatakan gagal !!.",
                timer: 11000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    finishExam('Membuka Tab baru');
                }
            });
        }
    });

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) {
            Swal.fire({
                title: " Melanggar Peraturan Ujian!",
                html: "Ujian tidak boleh membuka aplikasi lain. <br> Ujian Dinyatakan gagal !!.",
                timer: 11000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    finishExam('Ada aktifitas dilarang oleh ujian');
                }
            });
        }
    });

    window.addEventListener("keydown", function (event) {
        if (event.key === "F5" || event.key === "F6" || event.key === "r" || event.key === "R") {
            event.preventDefault();
            finishExam('Ketahuan Menekan Tombol Terlarang');
        }
    });

    window.addEventListener("popstate", function (event) {
        history.pushState(null, null, window.location.href);
        finishExam('Ketahuan Menggunakan History Browser');
    });

    window.addEventListener('keyup', (e) => {
        if (e.key == 'PrintScreen') {
            navigator.clipboard.writeText('');
            Swal.fire({
                title: " Melanggar Peraturan Ujian!",
                html: "Ujian tidak boleh membuka aplikasi lain. <br> Ujian Dinyatakan gagal !!.",
                timer: 11000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    document.getElementById('cheatInput').value = 'Membuka Tab baru';
                    curang();
                    finishExam('Mencoba Mengambil Screenshot');
                }
            });
        }
    });

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) {
            Swal.fire({
                title: " Melanggar Peraturan Ujian!",
                html: "Ujian tidak boleh membuka aplikasi lain. <br> Ujian Dinyatakan gagal !!.",
                timer: 11000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    document.getElementById('cheatInput').value =
                        'Ada aktifitas dilarang oleh ujian';
                    curang();
                    finishExam('Ada aktifitas dilarang oleh ujian');
                }
            });
        }
    });
</script>



</html>
