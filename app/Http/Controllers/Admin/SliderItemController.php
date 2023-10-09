<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderItem;
use Illuminate\Http\Request;

class SliderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::simplePaginate(10);
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slider_item = SliderItem::create($request->except('_token','_method','file'));

        return redirect()->route('admin.sliders.index')->with('success','Slider item created successfully');
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
        $slide_item = SliderItem::findOrFail($id);
        return view('admin.slider.edit',compact('slide_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider_item = SliderItem::findOrFail($id);
        $slider_item->update($request->except('_token','_method','file'));
        // upload file
        $this->update_file($request,$slider_item);

        return redirect()->route('admin.sliders.index')->with('success','Slider item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = SliderItem::findOrFail($id);
        if ($slider->file_name_desktop){
            unlink(storage_path('app/public/images/slider/'.$slider->file_name_desktop));
        }
        if ($slider->file_name_mobile){
            unlink(storage_path('app/public/images/slider/'.$slider->file_name_mobile));
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success','Slider item deleted successfully');
    }

    public function update_file($request,$slider_item){
        if($request->hasFile('file_dekstop')){
            $file = $request->file('file_dekstop');

            $file_name = time() . '-' . uniqid() . '-' .$file->getClientOriginalName();
            $file_type = $file->getClientOriginalExtension();

            // is this image
            if(in_array($file_type,['jpg','jpeg','png','gif'])){
                $file_type = 'image';
            }else if (in_array($file_type,['mp4','avi','mpeg'])){
                $file_type = 'video';
            }else{
                $file_type = 'file';
            }

            $file->move(storage_path('app/public/images/slider'),$file_name);

            $slider_item->update([
                'file_name_desktop' => $file_name,
                'file_type_desktop' => $file_type
            ]);
        }
        if ($request->hasFile('file_mobile')){
            $file = $request->file('file_mobile');

            $file_name = time() . '-' . uniqid() . '-' .$file->getClientOriginalName();
            $file_type = $file->getClientOriginalExtension();

            // is this image
            if(in_array($file_type,['jpg','jpeg','png','gif'])){
                $file_type = 'image';
            }else if (in_array($file_type,['mp4','avi','mpeg'])){
                $file_type = 'video';
            }else{
                $file_type = 'file';
            }

            $file->move(storage_path('app/public/images/slider'),$file_name);

            $slider_item->update([
                'file_name_mobile' => $file_name,
                'file_type_mobile' => $file_type
            ]);
        }
    }

}
