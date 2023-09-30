@extends('admin.layouts.general')

@section('content')
    <div class="content-wrapper">
        <iframe src="{{route('admin.media-library.iframe')}}?page=library-index" frameborder="0"
                style="width: 100%; height: 100vh"></iframe>
    </div>
@endsection
@push('extra-css')
    <style>
        .content-wrapper {
            min-height: 100vh !important;
        }
    </style>
@endpush
