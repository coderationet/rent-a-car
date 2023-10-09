<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HierarchicalListingHelper;
use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item_categories = ItemCategory::simplePaginate(10);
        return view('admin.item_category.index', compact('item_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item_categories = ItemCategory::where('parent_id',null)->get();
        return view('admin.item_category.edit', compact('item_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // name,parent_id
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'nullable|exists:item_categories,id',
            'slug' => 'required|unique:item_categories,slug',
        ]);

        if ($validate->fails()) {
            if ($request->has('response_type') && $request->response_type == 'json') {
                return response()->json([
                    'status' => 'error',
                    'msg' => $validate->errors()->first()
                ]);
            }
            return redirect()->back()->with('error',$validate->errors()->first());
        }

        if (!$request->has('parent_id')){
            $request->merge(['parent_id' => null]);
        }

        $new_category = ItemCategory::create($request->except('_token','_method'));

        if ($request->has('response_type') && $request->response_type == 'json') {
            $categories = ItemCategory::whereNull('parent_id')->orderBy('name','ASC')->get();
            $selected_categories = [];
            if ($request->has('selected_categories')) {
                $selected_categories = explode(',', $request->selected_categories) ;
            }
            $selected_categories[] = $new_category->id;
            return response()->json([
                'status' => 'success',
                'msg' => __('admin/category.msg.new_category_created_successfully'),
                'category_block_html' => HierarchicalListingHelper::get_listing_html($categories,$selected_categories,'categories[]')
            ]);
        }

        return redirect()->route('admin.item-categories.index')->with('success', __('admin/category.msg.new_category_created_successfully'));

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
        $item_category = ItemCategory::findOrFail($id);
        $item_categories = ItemCategory::whereNull('parent_id')->get();
        return view('admin.item_category.edit', compact('item_category','item_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'nullable|exists:item_categories,id',
            'slug' => 'required|unique:item_categories,slug,'.$id,
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error',$validate->errors()->first());
        }

        // parent_id cant be the same as id
        if($request->parent_id == $id){
            return redirect()->back()->with('error','Parent category can not be the same as the category itself');
        }

        // cant set parent_id to a child category
        if($request->parent_id){
            $all_childrenIds = ItemCategory::find($id)->allChildrenWithoutHierarchy();
            $all_childrenIds = array_map(function($item){
                return $item->id;
            },$all_childrenIds);
            if(in_array($request->parent_id, $all_childrenIds)){
                return redirect()->back()->with('error','Parent category can not be a child category');
            }
        }

        $item_category = ItemCategory::findOrFail($id);
        $item_category->update($request->except('_token','_method'));

        return redirect()->route('admin.item-categories.index')->with('success','Item Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item_category = ItemCategory::findOrFail($id);
        $item_category->delete();
        return redirect()->route('admin.item-categories.index')->with('success','Item Category deleted successfully');
    }

    public function new_category_form_html(){
        $item_categories = ItemCategory::whereNull('parent_id')->get();
        return view('admin.item_category._new_category_form', compact('item_categories'));
    }

    public function get_item_category(){
        $item = ItemCategory::query();

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
}
