<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\Option;
use App\Helpers\PaymentGatewayHelper;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['active_tab'] = 'payment';
        $data['default_payment_gateway'] = Option::get('default_payment_gateway');
        $data['payment_gateways'] = PaymentGatewayHelper::get_payment_gateways();

        return view('admin.setting.index',['settings' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $default_payment_gateway = $request->default_payment_gateway ?? '';
        Option::update('default_payment_gateway',$default_payment_gateway);

        // redirect to index page
        return redirect()->route('admin.settings.payment-settings.index')->with('success','Site settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
