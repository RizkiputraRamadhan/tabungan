<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/favicon.png') }}">
    <title>Dashboard</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/custom.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
    .scrollable::-webkit-scrollbar {
        width: 2px;
    }

    .scrollable::-webkit-scrollbar-thumb {
        background-color: #888888;
        /* Warna garis scroll */
        border-radius: 5px;
    }

    .scrollable::-webkit-scrollbar-track {
        background: transparent;
        /* Hapus latar belakang bayangan */
    }
</style>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="{{ url('home') }}">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <img width="80%" src="{{ asset('storage/logo_sipenting.png') }}" alt="homepage"
                                class="light-logo" />

                        </b>
                        <span class="logo-text">
                            <!--
                            <img width="40%" src="{{ asset('storage/logo_sipenting.png') }}" alt="homepage" class="light-logo" />
dark Logo text -->
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (auth()->user()->id == 1)
                                    <img src="{{ asset('storage/defalut/admin.jpg') }}" alt="admin"
                                        class="rounded-circle" width="40">
                                @else
                                    <img src="{{ asset('storage/defalut/user.png') }}" alt="user"
                                        class="rounded-circle" width="40">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <div class="dropdown-divider"></div>
                                <form id="keluar-app" action="{{ url('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i
                                        class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home') }}"
                                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Beranda</span></a>
                        </li>
                        @if (auth()->user()->typeuser == 1 || auth()->user()->typeuser == 2)
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/categories') }}" aria-expanded="false"><i
                                        class="mdi mdi-animation"></i><span class="hide-menu">Categories</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/siswa') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-key"></i><span class="hide-menu">Akun Siswa</span></a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/guru') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-key"></i><span class="hide-menu">Akun Guru</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/saving') }}" aria-expanded="false"><i
                                        class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">Tabungan</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/result') }}" aria-expanded="false"><i
                                        class="mdi mdi-chart-areaspline"></i><span class="hide-menu">Hasil
                                        Ujian</span></a>
                            </li>
                        @else
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/siswa/saving') }}" aria-expanded="false"><i
                                        class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">Tabungan</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/ujian') }}" aria-expanded="false"><i
                                        class="mdi mdi-chart-bar"></i><span class="hide-menu">Ujian</span></a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/diskusi') }}"
                                aria-expanded="false"><i class="mdi mdi-comment-multiple-outline"></i><span
                                    class="hide-menu">Diskusi</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">{{ $judul }}</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{ $judul }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $sub }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- isi -->
                @yield('content')
                <!-- isi end -->

                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Prodaction by SIPENTING'S.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <!-- this page js -->
    <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tangkap elemen tombol dan formulir
            var btnCreateQuestion = $('#btnCreateQuestion');
            var createQuestionForm = $('#createQuestionForm');

            // Atur event handler saat tombol diklik
            btnCreateQuestion.click(function() {
                // Toggle tampilan formulir
                createQuestionForm.slideToggle();
            });
        });
    </script>
    <!-- tambahan -->
    <!-- sweetalert -->
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>

    <!-- ckeditor  -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- sweetalert success-->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Gagal !!.',
                text: "{{ session('error') }}"
            });
        </script>
    @endif
    @if (session('errorToken'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ujian Sedang Berlangsung !!.',
                text: "{{ session('errorToken') }}"
            });
        </script>
    @endif
    @if (session('errorStatus'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ujian Tidak Ditemukan !!.',
                text: "{{ session('errorStatus') }}"
            });
        </script>
    @endif
    @if (session('ExplayedDate'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ujian Sudah Selesai !!.',
            });
        </script>
    @endif

    <script type="text/javascript">
        //sweetalert delete
        let timerInterval;
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data <strong>" + konfdelete + "</strong> yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Verifikasi Data!",
                        html: "Kami sedang check akun yang akan dihapus !!.",
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        //hanya angka
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        // previewImage
        function previewFoto() {
            const imageInput = document.querySelector('input[name="image"]');
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.style.display = 'block';
            const imageReader = new FileReader();

            imageReader.onload = function(event) {
                imagePreview.src = event.target.result;
            }

            if (imageInput.files[0]) {
                imageReader.readAsDataURL(imageInput.files[0]);
            }
        }

        // Tampilkan gambar melayang
        document.addEventListener('DOMContentLoaded', function() {
            var floatingImageLink = document.getElementById('floating-image-link');
            var floatingImageContainer = document.getElementById('floating-image-container');
            var floatingImage = document.getElementById('floating-image');

            floatingImageLink.addEventListener('click', function(event) {
                event.preventDefault();
                var imageSrc = this.getAttribute('data-image-src');
                floatingImage.src = imageSrc;
                floatingImageContainer.style.display = 'block';
            });

            floatingImageContainer.addEventListener('click', function() {
                this.style.display = 'none';
            });
        });
        $(document).ready(function() {
            $("#searchStudent").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                var searchResults = $("#searchResults");

                $("#searchResults li").filter(function() {
                    var isVisible = $(this).text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(isVisible);

                    if (isVisible == true && value.length <= 0) {
                        searchResults.hide();
                    } else if (isVisible == true && value.length > 0) {
                        searchResults.show();

                    }
                });

            });
        });


        function selectStudent(studentId, studentName) {
            document.getElementById('searchStudent').value = studentName;
            document.getElementById('idStudent').value = studentId.toString();
            document.getElementById('searchResults').style.display = 'none';
        }
    </script>

</body>

</html>
