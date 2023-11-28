<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{isset($page_title) ? $page_title . ' - Admin' : 'Admin Panel'}}</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet"
          href="{{route('front.home')}}/assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet"
          href="{{route('front.home')}}/assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="{{route('front.home')}}/assets/adminlte/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/jquery-ui/jquery-ui.min.css')}}">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(config('app.debug') && config('app.url') == 'https://cars.test')
        @vite('admin')
    @endif

    @stack('extra-css')
    @stack('extra-head')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <style>
        .select2-container .select2-selection--single {
            height: unset;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
            border-color: #006fe6 !important;
            color: #fff !important;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__shake" src="{{route('front.home')}}/assets/adminlte/dist/img/AdminLTELogo.png"--}}
{{--             alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('front.home')}}" class="nav-link" target="_blank">
                    <i class="fas fa-home"></i>
                    Ana Sayfa
                </a>
            </li>
        </ul>
        <!-- Logout -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{route('logout')}}" method="post" id="logout-form">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        {{__('admin/general.logout')}}
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="{{route('admin.dashboard')}}" class="brand-link">
            <img src="{{route('front.home')}}/assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{config('app.name')}}</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{route('front.home')}}/assets/adminlte/dist/img/user2-160x160.jpg"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('admin.dashboard')}}" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>
            <nav class="mt-2">
                @include("admin.layouts.menu")
            </nav>
        </div>
    </aside>

    @yield('content')

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://coderatio.net/get-a-quote">Coderatio.net</a>.</strong>
        {{__('admin/general.all_rights_reserved')}}
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>


<script src="{{route('front.home')}}/assets/adminlte/plugins/jquery/jquery.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/chart.js/Chart.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/sparklines/sparkline.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{route('front.home')}}/assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/moment/moment.min.js"></script>
<script src="{{route('front.home')}}/assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>

<script
    src="{{route('front.home')}}/assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="{{route('front.home')}}/assets/adminlte/dist/js/adminlte.js?v=3.2.0"></script>

<script src="{{route('front.home')}}/assets/adminlte/dist/js/pages/dashboard.js"></script>

<!-- Select2 script -->
<script src="{{asset('assets/adminlte/plugins/select2/js/select2.min.js')}}"></script>

<!-- inputmask script -->
<script src="{{asset('assets/adminlte/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

@stack('extra-footer')

<script>
    @if(session()->has('success'))
    // create taost message if session has success
    $(function () {
        $(document).Toasts('create', {
            title: 'Başarılı',
            body: '{{session('success')}}',
            autohide: true,
            autoHideDelay: 7000,
            class: 'bg-success',
            icon: 'fas fa-check',
            position: 'bottomRight',
        })
    });
    @elseif(session()->has('error'))
    // create toast message if session has error
    $(function () {
        $(document).Toasts('create', {
            title: 'Hata',
            body: '{{session('error')}}',
            autohide: true,
            class: 'bg-danger',
            icon: 'fas fa-times',
            position: 'bottomRight',
        })
    });
    @endif
</script>
</body>
</html>
