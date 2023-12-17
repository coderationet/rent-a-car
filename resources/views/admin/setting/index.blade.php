@extends('admin.layouts.general')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            {{__('admin/settings.settings')}}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/settings.settings')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{$settings['active_tab'] == 'general' ? 'active' : ''}}" id="custom-tabs-one-home-tab"
                                           href="{{route('admin.settings.general-settings.index')}}"
                                           aria-selected="{{$settings['active_tab'] == 'general' ? 'true' : 'false'}}">General
                                            Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{$settings['active_tab'] == 'payment' ? 'active' : ''}}" id="custom-tabs-one-payment-tab"
                                           href="{{route('admin.settings.payment-settings.index')}}"
                                           aria-selected="{{$settings['active_tab'] == 'payment' ? 'true' : 'false'}}">Payment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-general" role="tabpanel">
                                       @include('admin.setting.tab.'.$settings['active_tab'],$settings)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
