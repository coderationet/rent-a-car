<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        # if image is uploaded
        $data = $request->except('_token');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $file_ext = $image->getClientOriginalExtension();
            $file_name = str_replace('.'.$file_ext,'',$file_name); // remove extension from file name
            $image_name = time().'_'.str($file_name)->slug('_').'.'.$file_ext;
            $image->move(storage_path('app/public/images/blog'),$image_name);
            $data['image'] = $image_name;
        }

        $blog = Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success','Blog created successfully');
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
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $page = Blog::findOrFail($id);
        # update image if uploaded
        $data = $request->except('_token');
        if($request->hasFile('image')){

            // remove old image
            if($page->image){
                $image_path = storage_path('app/public/images/blog/'.$page->image);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }

            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $file_ext = $image->getClientOriginalExtension();
            $file_name = str_replace('.'.$file_ext,'',$file_name); // remove extension from file name
            $image_name = time().'_'.str($file_name)->slug('_').'.'.$file_ext;
            $image->move(storage_path('app/public/images/blog'),$image_name);
            $data['image'] = $image_name;
        }
        $page->update($data);
        return redirect()->route('admin.blogs.index')->with('success','Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success','Blog deleted successfully');
    }
}
