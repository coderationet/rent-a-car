<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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


    <link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">


</head>
<body>

<div class="admin-panel-template">
    <div class="sidebar">
        @include("admin.layouts.sidebar")
    </div>
    <div class="content">
        @yield("content")
    </div>
</div>

<!-- Jquery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}" defer></script>

<!-- Select2 script -->
<script src="{{asset('assets/admin/plugins/select2/js/select2.min.js')}}" defer></script>

<!-- Select2 script -->
<script src="{{asset('assets/admin/plugins/summernote/summernote.min.js')}}"></script>

@stack('extra-footer')

</body>
</html>
