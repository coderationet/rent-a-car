@extends('admin.layouts.general')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('admin/general.create_new')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/reservations.reservations')}}</li>
                            <li class="breadcrumb-item active">{{isset($reservation) ? __('admin/reservations.update_reservation') : __('admin/reservations.create_new_reservation')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{isset($reservation) ? route('admin.items.update',$reservation->id)  : route('admin.items.store')}}"
                      method="post">
                    @csrf
                    @if(isset($reservation))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">

                                        <div class="card-header">
                                            <h3 class="card-title">{{__('admin/general.add_new')}}</h3>
                                        </div>

                                        <div class="card-body item-form">
                                            <div class="form-group">
                                                <!-- user -->
                                                <label for="user">{{__('admin/general.user')}}</label>
                                                <select name="user_id" id="user" class="form-control user-data-select2">
                                                    <option value="">{{__('admin/general.select')}}</option>
                                                    @if(isset($reservation->user))
                                                        <option value="{{$reservation->user->user_id}}" selected>{{$reservation->user->name}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <!-- item -->
                                                <label for="item">{{__('admin/item.item')}}</label>
                                                <select name="item_id" id="item" class="form-control">
                                                    <option value="">{{__('admin/general.select')}}</option>
                                                    @if(isset($reservation->item))
                                                        <option value="{{$reservation->item->id}}" selected>{{$reservation->item->title}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <!-- Start Date -->
                                                <label for="start_date">{{__('admin/reservations.start_date')}}</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{isset($reservation) ? $reservation->start_date : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- End Date -->
                                                <label for="end_date">{{__('admin/reservations.end_date')}}</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{isset($reservation) ? $reservation->end_date : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- Status -->
                                                <label for="status">{{__('admin/reservations.status')}}</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">{{__('admin/general.select')}}</option>
                                                    <option value="created" @if(isset($reservation->status) && $reservation->status == 'created') selected @endif>{{__('admin/reservations.created')}}</option>
                                                    <option value="pending" @if(isset($reservation->status) && $reservation->status == 'pending') selected @endif>{{__('admin/reservations.pending')}}</option>
                                                    <option value="approved" @if(isset($reservation->status) && $reservation->status == 'approved') selected @endif>{{__('admin/reservations.approved')}}</option>
                                                    <option value="declined" @if(isset($reservation->status) && $reservation->status == 'declined') selected @endif>{{__('admin/reservations.declined')}}</option>
                                               </select>
                                            </div>
                                            <div class="form-group">
                                                <!-- Code -->
                                                <label for="code">{{__('admin/reservations.code')}}</label>
                                                <input type="text" name="code" id="code" class="form-control" value="{{isset($reservation) ? $reservation->code : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- Notes -->
                                                <label for="notes">{{__('admin/reservations.notes')}}</label>
                                                <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{isset($reservation) ? $reservation->notes : ''}}</textarea>
                                            </div>
                                            <!-- Payment Information -->
                                            <h3>{{__('admin/reservations.driver_informations')}}</h3>
                                            <!-- Driver Informations : email, user_name, user_address, user_phone, user_ip -->
                                            <div class="form-group">
                                                <!-- email -->
                                                <label for="email">{{__('admin/general.email')}}</label>
                                                <input type="text" name="email" id="email" class="form-control" value="{{isset($reservation) ? $reservation->email : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- user_name -->
                                                <label for="user_name">{{__('admin/reservations.user_name')}}</label>
                                                <input type="text" name="user_name" id="user_name" class="form-control" value="{{isset($reservation) ? $reservation->user_name : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- user_surname -->
                                                <label for="user_surname">{{__('admin/reservations.user_surname')}}</label>
                                                <input type="text" name="user_surname" id="user_surname" class="form-control" value="{{isset($reservation) ? $reservation->user_surname : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- user_phone -->
                                                <label for="user_phone">{{__('admin/reservations.user_phone')}}</label>
                                                <input type="text" name="user_phone" id="user_phone" class="form-control" value="{{isset($reservation) ? $reservation->user_phone : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- user_ip -->
                                                <label for="user_ip">{{__('admin/reservations.user_ip')}}</label>
                                                <input type="text" name="user_ip" id="user_ip" class="form-control" value="{{isset($reservation) ? $reservation->user_ip : ''}}">
                                            </div>
                                            <h3>{{__('admin/reservations.payment_information')}}</h3>
                                            <!-- Payment Information: invoice_type,invoice_company_type,invoice_company_name,invoice_company_address,invoice_company_vat_number,tax_administration -->
                                            <div class="form-group">
                                                <!-- invoice_type -->
                                                <label for="invoice_type">{{__('admin/reservations.invoice_type')}}</label>
                                                <select name="invoice_type" id="invoice_type" class="form-control">
                                                    <option value="">{{__('admin/general.select')}}</option>
                                                    <option value="individual" @if(isset($reservation->invoice_type) && $reservation->invoice_type == 'individual') selected @endif>{{__('admin/reservations.individual')}}</option>
                                                    <option value="company" @if(isset($reservation->invoice_type) && $reservation->invoice_type == 'company') selected @endif>{{__('admin/reservations.company')}}</option>
                                                </select>
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <!-- invoice_company_type -->--}}
{{--                                                <label for="invoice_company_type">{{__('admin/reservations.invoice_company_type')}}</label>--}}
{{--                                                <select name="invoice_company_type" id="invoice_company_type" class="form-control">--}}
{{--                                                    <option value="">{{__('admin/general.select')}}</option>--}}
{{--                                                    <option value="individual" @if(isset($reservation->invoice_company_type) && $reservation->invoice_company_type == 'individual') selected @endif>{{__('admin/reservations.individual')}}</option>--}}
{{--                                                    <option value="company" @if(isset($reservation->invoice_company_type) && $reservation->invoice_company_type == 'company') selected @endif>{{__('admin/reservations.company')}}</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <!-- invoice_company_name -->
                                                <label for="invoice_company_name">{{__('admin/reservations.invoice_company_name')}}</label>
                                                <input type="text" name="invoice_company_name" id="invoice_company_name" class="form-control" value="{{isset($reservation) ? $reservation->invoice_company_name : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- invoice_company_address -->
                                                <label for="invoice_company_address">{{__('admin/reservations.invoice_company_address')}}</label>
                                                <input type="text" name="invoice_company_address" id="invoice_company_address" class="form-control" value="{{isset($reservation) ? $reservation->invoice_company_address : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- invoice_company_vat_number -->
                                                <label for="invoice_company_vat_number">{{__('admin/reservations.invoice_company_vat_number')}}</label>
                                                <input type="text" name="invoice_company_vat_number" id="invoice_company_vat_number" class="form-control" value="{{isset($reservation) ? $reservation->invoice_company_vat_number : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_id -->
                                                <label for="payment_id">{{__('admin/reservations.payment_id')}}</label>
                                                <input type="text" name="payment_id" id="payment_id" class="form-control" value="{{isset($reservation) ? $reservation->payment_id : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_method -->
                                                <label for="payment_method">{{__('admin/reservations.payment_method')}}</label>
                                                <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{isset($reservation) ? $reservation->payment_method : ''}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_status -->
                                                <label for="payment_status">{{__('admin/reservations.payment_status')}}</label>
                                                <select name="payment_status" id="payment_status" class="form-control">
                                                    <option value="">{{__('admin/general.select')}}</option>
                                                    <option value="created" @if(isset($reservation->payment_status) && $reservation->payment_status == 'created') selected @endif>{{__('admin/reservations.created')}}</option>
                                                    <option value="pending" @if(isset($reservation->payment_status) && $reservation->payment_status == 'pending') selected @endif>{{__('admin/reservations.pending')}}</option>
                                                    <option value="approved" @if(isset($reservation->payment_status) && $reservation->payment_status == 'approved') selected @endif>{{__('admin/reservations.approved')}}</option>
                                                    <option value="declined" @if(isset($reservation->payment_status) && $reservation->payment_status == 'declined') selected @endif>{{__('admin/reservations.declined')}}</option>
                                                    <option value="refunded" @if(isset($reservation->payment_status) && $reservation->payment_status == 'refunded') selected @endif>{{__('admin/reservations.refunded')}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_amount -->
                                                <label for="payment_amount">{{__('admin/reservations.payment_amount')}}</label>
                                                <input type="text" name="payment_amount" id="payment_amount" class="form-control" value="{{isset($reservation) ? $reservation->payment_amount : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_currency -->
                                                <label for="payment_currency">{{__('admin/reservations.payment_currency')}}</label>
                                                <input type="text" name="payment_currency" id="payment_currency" class="form-control" value="{{isset($reservation) ? $reservation->payment_currency : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- payment_date -->
                                                <label for="payment_date">{{__('admin/reservations.payment_date')}}</label>
                                                <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{isset($reservation) ? $reservation->payment_date : ''}}">
                                            </div>

                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                {{isset($reservation) ? __('admin/general.update') : __('admin/general.add_new')}}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('extra-footer')

    <!-- Modal to create new category dialog -->
    <!-- Modal -->
    <div class="modal fade" id="create-new-category-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin/category.create_new_category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button"
                            class="btn btn-primary create-new-category-ajax">{{__('admin/general.add_new')}}</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('assets/admin/summernote/custom-image-dialog.plugin.js')}}"></script>

    @include('admin.js.summernote-turkish')

    <script type="module">
        $(function(){
            $('.user-data-select2').select2({
                ajax: {
                    url: '{{route('admin.users.ajax_data')}}',
                    dataType: 'json'
                }
            });
            $('#item').select2({
                ajax: {
                    url: '{{route('admin.items.ajax_data')}}',
                    dataType: 'json'
                }
            });

        });
    </script>
    <style>



    </style>
@endpush
