@extends('admin.layouts.general')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin/user.users')}}</li>
                    <li class="breadcrumb-item active">{{__('admin/user.add_user')}}</li>
                </ol>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin/user.add_user')}}</h3>
                            </div>
                            <form method="post"
                                  action="{{isset($user) ? route('admin.users.update',$user->id) : route('admin.users.store')}}">
                                @csrf
                                @if(isset($user))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    <!-- user name -->
                                    <div class="form-group">
                                        <label for="name">{{__('admin/general.name')}}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="{{__('admin/general.name')}}"
                                               required
                                               value="{{isset($user) ? $user->name : old('name')}}">
                                    </div>
                                    <!-- user email -->
                                    <div class="form-group">
                                        <label for="email">{{__('admin/general.email')}}</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               required
                                               placeholder="{{__('admin/general.email')}}"
                                               value="{{isset($user) ? $user->email : old('email')}}">
                                    </div>
                                    <!-- user password -->
                                    <div class="form-group">
                                        <label for="password">
                                            {{__('admin/user.msg.change_password_rule')}}
                                        </label>
                                        <input type="password"
                                               minlength="6"
                                               class="form-control" id="password" name="password"
                                               placeholder="{{__('admin/general.password')}}">
                                        <!-- confirmation -->
                                        <input type="password"
                                               minlength="6"
                                               class="form-control mt-2" id="password_confirmation"
                                               name="password_confirmation"
                                               placeholder="{{__('admin/general.repeat_password')}}">

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($user) ? __('admin/general.update') : __('admin/general.add')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
