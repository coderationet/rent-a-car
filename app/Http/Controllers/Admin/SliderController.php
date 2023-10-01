<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderItem;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        Slider::create($request->except('_token','_method','file'));

        return redirect()->route('admin.sliders.index')->with('success',__('admin/slider.msg.slider_created_successfully'));
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
        $slider = Slider::with('sliderImages')->findOrFail($id);
        foreach ($slider->sliderImages as $sliderImage) {
            foreach ($sliderImage->attributesToArray() as $key => $value) {
                $key = $sliderImage->order.'_input_'.$key;
                $sliderImage->$key = $value;
            }
        }

        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update($request->except('_token','_method','file'));

        if ($request->has('update_items')){
            $data = [];

            foreach ($request->all() as $slide_item_key => $slide_item_value){
                if (strpos($slide_item_key,'_input_') !== false){
                    $key = explode('_input_',$slide_item_key)[1];
                    if (!isset($data[$key])) {
                        $data[$key] = [];
                    }
                    $data[$key][] = $slide_item_value;
                }
            }

            // delete all slider items first
            $slider->sliderImages()->delete();

            $order = 0;

            // create new slider items
            for ($i = 0;$i < count($data['file_desktop']); $i++){
                $title = $data['title'][$i];
                $sub_title = $data['sub_title'][$i];
                $file_desktop = $data['file_desktop'][$i];
                $file_mobile = $data['file_mobile'][$i];
                $link = $data['link'][$i];
                $link_text = $data['link_text'][$i];

                $slider->sliderImages()->create([
                    'title' => $title,
                    'sub_title' => $sub_title,
                    'file_desktop' => $file_desktop,
                    'file_mobile' => $file_mobile,
                    'link' => $link,
                    'link_text' => $link_text,
                    'order' => $order++
                ]);
            }
        }

        return redirect()->route('admin.sliders.index')->with('success',__('admin/slider.msg.slider_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success',__('admin/slider.msg.slider_deleted_successfully'));
    }

    public function slider_item_row_html(Request $request)
    {
        $slider_item_index = $request->slider_item_index;
        return view('admin.slider._item_value_row',compact('slider_item_index'));
    }
}
