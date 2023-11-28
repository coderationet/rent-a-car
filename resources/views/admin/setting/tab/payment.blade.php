<form action="{{route('admin.settings.payment-settings.update',1)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="default_payment_method">{{__('admin/settings.default_payment_gateway')}}</label>
        <select name="default_payment_gateway" id="default_payment_gateway" class="form-control" required>
            @foreach($payment_gateways as $payment_gateway)
                <option value="{{$payment_gateway->get_payment_gateway_id()}}" {{($default_payment_gateway == $payment_gateway->get_payment_gateway_id()) ? 'selected' : ''}}>{{$payment_gateway->get_payment_gateway_name()}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{__('admin/general.save')}}</button>
</form>
