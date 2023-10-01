@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('admin/contact.all_messages')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin/contact.all_messages')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin/contact.message_details')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('admin/general.name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$message->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{__('admin/general.email')}}</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$message->email}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="subject">{{__('admin/contact.message')}}</label>
                                    <textarea class="form-control" id="subject" name="subject" rows="5" disabled>{{$message->message}}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-head')
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px !important;
        }

        .contact-messages {
            width: 100%;
            border-collapse: collapse;
        }

        .contact-messages th {
            text-align: left;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .contact-messages td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

    </style>
@endsection

@section('extra-footer')

@endsection
