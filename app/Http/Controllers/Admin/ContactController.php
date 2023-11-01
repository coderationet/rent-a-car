<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.contact.index');
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
        $message = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Contact::findOrFail($id);
        $message->update($request->except(['_token','_method']));
        return redirect()->route('admin.contacts.index')->with('success', 'Message updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted successfully');
    }

    public function data(){

        $messages = Contact::query();

        $response = [];

        $response['draw'] = request()->get('draw');

        $response['recordsTotal'] = $messages->count();
        $response['recordsFiltered'] = $messages->count();

        $offset = request()->get('start');
        $limit = request()->get('length');

        # order

        $order = request()->get('order');
        $order_by = $order[0]['column'];
        $order_direction = $order[0]['dir'];
        $order_column = request()->get('columns')[$order_by]['data'];

        $messages->orderBy($order_column, $order_direction);

        $data = $messages->offset($offset)->limit($limit)->get()->map(function ($message){
            return [
                "id" => "#" .$message->id,
                "name" => $message->name,
                "actions" => view('admin.contact.actions', compact('message'))->render()
            ];
        });
        $response['data'] = $data;
        // pagination
        $response['pagination']['more'] = false;

        return response()->json($response);

    }
}
