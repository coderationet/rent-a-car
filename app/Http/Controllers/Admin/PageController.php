<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
                ['name' => 'required|string|max:255'],
                ['slug' => 'required|string|unique:pages,slug']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->except('_token');
        $data['is_protected'] = false;
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function get_page()
    {
        $item = Page::query();

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
//            'page_type' => 'required|string|in:normal,product_tab,package_description',
        ]);

        $page = Page::findOrFail($id);

        if ($page->is_protected) {
            $page->update($request->except('_token', 'is_protected', 'page_type'));
            return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
        }

        $page->update($request->except('_token'));

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        if ($page->is_protected) {
            return redirect()->route('admin.pages.index')->with('error', 'Page is protected');
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }

    public function data()
    {

        $pages = Page::query();


        if (request()->has('page_type')) {
            $pages->where('page_type', request()->get('page_type'));
        }

        // column 0 search value
        $columns = request()->get('columns');


        if (isset($columns[1]['search']['value'])) {
            $search = $columns[1]['search']['value'];
            $pages->where('name', 'LIKE', "%{$search}%");
        }


        $count = $pages->count();

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

        if (request()->has('order')) {
            $order = $columns[request()->get('order')[0]['column']]['data'];
            $order_by = $order;
            $order_dir = request()->get('order')[0]['dir'];
        }

        $pages = $pages->orderBy($order_by, $order_dir)->offset($offset)->limit($limit)->get()->map(function ($page) {
            return [
                "id" => $page->id,
                "name" => $page->name,
                "actions" => view('admin.page.actions', ['page' => $page])->render(),
            ];
        });

        // pagination
        $response['pagination']['more'] = true;
        $response['data'] = $pages;

        return response()->json($response);
    }
}
