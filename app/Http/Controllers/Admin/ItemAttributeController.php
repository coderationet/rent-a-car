<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::simplePaginate(10);
        return view('admin.item_attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.item_attribute.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // name
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "type" => "required|string|in:select,radio,checkbox,multiselect",
            "slug" => "required|string|max:255|unique:attributes,slug",
        ]);

        if ($validator->fails()) {
            if ($request->has('response_type') && $request->response_type == "json") {
                return response()->json([
                    'status' => "error",
                    'msg' => $validator->errors()->first(),
                    'data' => null
                ]);
            }
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // check if attribute already exists
        $attribute = Attribute::where('name', $request->name)->first();
        if ($attribute) {
            if ($request->has('response_type') && $request->response_type == "json") {
                return response()->json([
                    'status' => "error",
                    'msg' => 'Attribute already exists.',
                    'data' => $attribute
                ]);
            }
            return redirect()->route('admin.item-attributes.index')->with('error', 'Attribute already exists.');
        }

        // create
        $attribute = Attribute::create([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
        ]);

        if ($request->has('response_type') && $request->response_type == "json") {
            return response()->json([
                'status' => "success",
                'msg' => 'Attribute created.',
                'data' => $attribute
            ]);
        }

        // redirect
        return redirect()->route('admin.item-attributes.index')->with('success', 'Attribute created.');

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
        $attribute = Attribute::findOrFail($id);
        $attribute_values = $attribute->values()->simplePaginate(10);
        return view('admin.item_attribute.edit', compact('attribute', 'attribute_values'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:select,radio,checkbox,multiselect',
            'slug' => 'required|string|max:255|unique:attributes,slug,' . $id,
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        // update
        $attribute = Attribute::findOrFail($id);
        $attribute->update([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
        ]);

        // redirect
        return redirect()->route('admin.item-attributes.index')->with('success', 'Attribute updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('admin.item-attributes.index')->with('success', 'Attribute deleted.');
    }

    function ajax_data()
    {
        // ajax data for select2
        $attributes = Attribute::query();

        if (request()->has('q')) {
            $search = request()->get('q');
            # search in brand + model + base_color + color_code combinated name
            # search in product name
            $attributes->where('name', 'LIKE', "%$search%");
        }

        if (request()->has('attribute_id')) {
            $attributes->where('id', request()->get('attribute_id'));
        }

        $page = request()->get('page');

        $offset = 0;

        if ($page > 1) {
            $offset = 20 * ($page - 1);
        }

        $attributes = $attributes->limit(20)->offset($offset)->get();

        $response = [];
        foreach ($attributes as $attribute) {
            $response[] = [
                "id" => $attribute->id,
                "text" => $attribute->name,
            ];
        }
        return response()->json([
            'results' => $response
        ]);
    }

    function get_item_attribute()
    {

        $item = Attribute::query();

        //except_post_id
        if (request()->has('except_post_id')) {
            $except_post_id = request()->get('except_post_id');
            $item = $item->where('id', '!=', $except_post_id);
        }

        // check based on slug
        if (request()->has('slug')) {
            $slug = request()->get('slug');
            $item = $item->where('slug', $slug);
        }

        // check based on id
        if (request()->has('id')) {
            $id = request()->get('id');
            $item = $item->where('id', '!=', $id);
        }

        $item = $item->first();

        if ($item) {
            return response()->json(['exists' => true, 'item' => $item, 'msg' => __('admin/item.msg.slug_exists')]);
        }

        return response()->json(['exists' => false, 'msg' => __('admin/item.msg.slug_not_exists')]);
    }
}
