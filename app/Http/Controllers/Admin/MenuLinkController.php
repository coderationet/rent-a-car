<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuLink;
use Illuminate\Http\Request;

class MenuLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = [
            'touch-up-paint' => [
                'name' => "Touch Up Paint",
                'parent_id' => "touch-up-paint",
            ],
            'ceramic-coating' => [
                'name' => "Ceramic Coating",
                'parent_id' => "ceramic-coating",
            ]
        ];

        $links = MenuLink::all();

        foreach ($links as $link) {
            if ($link->parent_id) {
                $link->parent_name = $parents[$link->parent_id]['name'];
            } else {
                $link->parent_name = "None";
            }
        }


        return view('admin.menu-link.index', compact('links','parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = [
            [
                'name' => "Touch Up Paint",
                'parent_id' => "touch-up-paint",
            ],
            [
                'name' => "Ceramic Coating",
                'parent_id' => "ceramic-coating",
            ]
        ];

        // convert to object
        $parents = json_decode(json_encode($parents));

        return view('admin.menu-link.edit', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'parent_id' => 'required',
            'order' => 'required',
        ]);

        $link = new MenuLink();
        $link->name = $request->name;
        $link->url = $request->url;
        $link->parent_id = $request->parent_id;
        $link->order = $request->order;
        $link->save();

        return redirect()->route('admin.menu-links.index')->with('success', 'Menu link created successfully.');
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
        $link = MenuLink::findOrFail($id);

        $parents = [
            [
                'name' => "Touch Up Paint",
                'parent_id' => "touch-up-paint",
            ],
            [
                'name' => "Ceramic Coating",
                'parent_id' => "ceramic-coating",
            ]
        ];

        // convert to object
        $parents = json_decode(json_encode($parents));

        return view('admin.menu-link.edit', compact('link','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'parent_id' => 'required',
            'order' => 'required',
        ]);

        $link = MenuLink::findOrFail($id);
        $link->name = $request->name;
        $link->url = $request->url;
        $link->parent_id = $request->parent_id;
        $link->order = $request->order;
        $link->save();

        return redirect()->route('admin.menu-links.index')->with('success', 'Menu link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = MenuLink::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.menu-links.index')->with('success', 'Menu link deleted successfully.');
    }
}
