<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

use App\Models\Attribute;

class ItemAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $attribute_id = request()->get('attribute_id');

        return view('admin.item_attribute_value.edit', compact('attribute_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // attribute_id
        // value

        $request->validate([
            'attribute_id' => 'required',
            'value' => 'required',
        ]);

        // check if strict attributes is enabled

        // check if is this value exists  first

        $attribute_value = AttributeValue::where([
            "attribute_id" => $request->attribute_id,
            "value" => $request->value
        ]);

        if ($attribute_value->exists() && $request->has('response_type') && $request->response_type == "json"){
            return response()->json([
                "msg" => __('admin/general.value_already_exists'),
                "status" => "failed"
            ]);
        }

        if ($attribute_value->exists()){
            return redirect()->route('admin.item-attributes.edit', $request->attribute_id)->with('error', __('admin/attributes.msg.attribute_already_exists'));
        }

        // create new value

        $attribute_value = AttributeValue::create([
            "value" => $request->value,
            "attribute_id" => $request->attribute_id
        ]);

        if ($request->has('response_type') && $request->response_type == "json"){
            return response()->json([
                "msg" => __('admin/attributes.msg.new_value_created'),
                "status" => "success"
            ]);
        }

        return redirect()->route('admin.item-attributes.edit', $attribute_value->attribute_id)->with('success', 'Attribute value created successfully');
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
        $attribute_value = AttributeValue::findOrFail($id);
        return view('admin.item_attribute_value.edit', compact('attribute_value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->value = $request->post('value');
        $attribute_value->save();

        return redirect()->route('admin.item-attributes.edit', $attribute_value->attribute_id)->with('success', 'Attribute value updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->delete();

        return redirect()->back()->with('success', 'Attribute value deleted successfully');
    }

    function ajax_data(){
        // ajax data for select2
        $attribute_values = AttributeValue::query();

        if (request()->has('q')) {
            $search = request()->get('q');
            # search in brand + model + base_color + color_code combinated name
            # search in product name
            $attribute_values->where('value', 'LIKE', "%$search%");
        }

        if (request()->has('attribute_id')){
            $attribute_values->where('attribute_id', request()->get('attribute_id'));
        }

        $page = request()->get('page');

        $offset = 0;

        if ($page > 1) {
            $offset = 20 * ($page - 1);
        }

        $attribute_values = $attribute_values->limit(20)->offset($offset)->get();

        $response = [];
        foreach ($attribute_values as $attribute_value) {
            $response[] = [
                "id" => $attribute_value->id,
                "text" => $attribute_value->value,
            ];
        }
        return response()->json([
            'results' => $response
        ]);
    }
}
