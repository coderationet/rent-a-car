<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AttributeHelper;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Item;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ItemController extends Controller
{
    public function index()
    {
        $items = Item::simplePaginate(10);
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = ItemCategory::whereNull('parent_id')->orderBy('name','ASC')->get();
        $selected_categories = [];
        $strict_attributes = config('website.strict_attributes');

        $item_attributes = AttributeHelper::defaultItemAttributes(null,config('website.default_attributes'));

        return view('admin.items.edit', compact('categories','strict_attributes','selected_categories','item_attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'slug' => ['string', 'required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', __('admin/general.msg.invalid_data'));
        }
        // create a new item
        $item = new Item();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->slug = $request->slug;

        if ($request->has('thumbnail_id')) {
            $item->thumbnail_id = $request->thumbnail_id;
        }

        // check if slug is exsits
        $slug = $request->slug;
        $item_check = Item::where('slug', $slug)->first();
        if ($item_check) {
            return redirect()->back()->with('error', __('admin/item.msg.slug_exists'));
        }

        // save the item
        $item->save();

        // gallery
        if ($request->has('gallery_ids') && !empty($request->gallery_ids)) {
            $item->gallery()->sync(explode(',', $request->gallery_ids));
        }

        $attribute_values = [];
        // attribute_values
        if ($request->has('attribute_values')){
            $attribute_values = $request->attribute_values;
        }
        //

        $item->attributeValues()->sync($attribute_values);

        // categories[] for ItemCategory

        $categories = [];

        if ($request->has('categories') && !empty($request->categories)) {
            $categories = $request->categories;
        }

        $item->categories()->sync($categories);



        // redirect to items.index
        return redirect()->route('admin.items.index')->with('success', 'İlan Kaydedildi');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function get_item(){

        $item = Item::query();

        //except_post_id
        if (request()->has('except_post_id')){
            $except_post_id = request()->get('except_post_id');
            $item = $item->where('id','!=',$except_post_id);
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
            return response()->json(['exists' => true,'item' => $item,'msg' => __('admin/item.msg.slug_exists')]);
        }

        return response()->json(['exists' => false,'msg' => __('admin/item.msg.slug_not_exists')]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);

        $item_attributes = [];

        if (config('website.strict_attributes') == true){
            $item_attributes = AttributeHelper::defaultItemAttributes($item);
        }else{
            $item_attributes = AttributeHelper::itemAttributes($item);
        }


        $categories = ItemCategory::whereNull('parent_id')->orderBy('name','ASC')->get();

        $selected_categories = $item->categories->pluck('id')->toArray();

        return view('admin.items.edit', compact('item','item_attributes','categories','selected_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'İlan Güncellenemedi');
        }
        // create a new item
        $item = Item::findOrFail($id);
        $item->title = $request->title;
        $item->description = $request->description;

        if ($request->has('thumbnail_id')) {
            $item->thumbnail_id = $request->thumbnail_id;
        }
        // gallery
        if ($request->has('gallery_ids') && !empty($request->gallery_ids)) {
            $item_ids = explode(',', $request->gallery_ids);
            $item->gallery()->sync($item_ids);
        }

        $attribute_values = [];
        // attribute_values
        if ($request->has('attribute_values')){
            $attribute_values = $request->attribute_values;
        }

        $item->attributeValues()->sync($attribute_values);


        // categories[] for ItemCategory

        $categories = [];

        if ($request->has('categories') && !empty($request->categories)) {
            $categories = $request->categories;
        }

        $item->categories()->sync($categories);


        // check if slug is exsits
        $slug = $request->slug;
        $item_check = Item::where('slug', $slug)->where('id','!=',$id)->first();
        if ($item_check) {
            return redirect()->back()->with('error', __('admin/item.msg.slug_exists'));
        }

        $item->slug = $request->slug;

        // save the item
        $item->save();

        // redirect to items.index
        return redirect()->route('admin.items.index')->with('success', 'İlan Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'İlan Silindi');
    }


    public function data()
    {
        $items = Item::query();

        // column 0 search value
        $columns = request()->get('columns');

        if(isset($columns[1]['search']['value'])){
            $search = $columns[1]['search']['value'];
            $items->where('title','LIKE',"%{$search}%");
        }


        $count = $items->count();

        // prepare response for datatable
        $response = [];
        $response['draw'] = request()->get('draw');
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        // data without column names
        // get page from url query parameter or set default
        $limit = request()->get('length') ?? 10;
        $offset = request()->get('start') ?? 0;

        # default order desc by id
        $order_by = 'id';
        $order_dir = 'desc';

        if(request()->has('order')){
            $order = $columns[request()->get('order')[0]['column']]['data'];
            $order_by = $order;
            $order_dir = request()->get('order')[0]['dir'];
        }

        $items = $items->orderBy($order_by,$order_dir)->offset($offset)->limit($limit)->get()->map(function ($item) {
            return [
                "id" => $item->id,
                "title" => $item->title,
                "short_description" => str(strip_tags($item->description))->limit(50),
                "actions" => view('admin.items.actions', compact('item'))->render()
            ];
        });

        // pagination
        $response['pagination']['more'] = true;
        $response['data'] = $items;

        return response()->json($response);
    }

    public function attribute_value_row_html(){
        $attribute_id = request()->get('attribute_id');
        $attribute = Attribute::findOrFail($attribute_id);
        $item_attribute = [
            "name" => $attribute->name,
            "id" => $attribute->id,
            "values" => [],
            "type" => $attribute->type
        ];
        return view('admin.items._attribute_value_row', compact('item_attribute'))->render();
    }
}
