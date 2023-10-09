<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.media_library.index');
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
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . rand(0, 99999) . '-' . uniqid() . '-' . $file->getClientOriginalName();
            // is image, video or audio or other
            $type = $file->getMimeType();
            $type = explode('/', $type)[0];
            $file->storeAs('public/media', $filename);
            $media = Media::create([
                'name' => $filename,
                'type' => $type,
            ]);
            return response()->json([
                'success' => true,
                'file' => [
                    'url' => asset('storage/media/' . $filename),
                    'id' => $media->id,
                    'type' => $type,
                    'name' => $filename,
                ],
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function iframe()
    {
        $items = Media::orderBy('id', 'DESC')->simplePaginate(20);
        $page = request()->has('page') ? request()->get('page') : 'no';
        $is_multiple = request()->has('is_multiple') ? request()->get('is_multiple') : 'no';
        $max_size = $this->file_upload_max_size();
        return view('admin.media_library.iframe', compact('items', 'page', 'is_multiple', 'max_size'));
    }
    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
    function file_upload_max_size()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = $this->parse_size(ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = $this->parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        // format to MB
        $max_size = $max_size / 1024 / 1024;
        return $max_size;
    }

    function parse_size($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }

    function media_block_html(Request $request){

        $data = [];

        if($request->has('input_name')){
            $data['input_name'] = $request->post('input_name');
        }

        // relation
        if($request->has('relation')){
            $data['relation'] = $request->post('relation');
        }

        // item
        $data['item'] = null;
        if($request->has('item')){
            $data['item'] = $request->post('item');
        }

        // multiple_file
        $data['multiple_file'] = false;
        if($request->has('multiple_file')){
            $data['multiple_file'] = $request->post('multiple_file');
        }

        return view('admin.media_library._input',$data)->render();
    }
}
