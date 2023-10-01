<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Helpers\Option;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'site_title' => Option::get('site_title'),
            'site_description' => Option::get('site_description'),
            'facebook_url' => Option::get('facebook_url'),
            'twitter_url' => Option::get('twitter_url'),
            'instagram_url' => Option::get('instagram_url'),
            'youtube_url' => Option::get('youtube_url'),
            'footer_html' => Option::get('footer_html'),
            'header_html' => Option::get('header_html'),
            'logo_id' => Option::get('logo_id'),
        ];

        if ($data['logo_id'] != null){
            $data['logo_id'] = [];
            $data['logo_id']['logo_id'] = Option::get('logo_id');
            $data['logo_id']['image'] = Media::find(Option::get('logo_id'));
            $data['logo_id'] = json_decode(json_encode($data['logo_id']));
        }


        return view('admin.setting.index',$data);
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
        //
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
        // update all fields if request send from form otherwise update as empty
        $site_title = $request->input('site_title') ?? '';
        $site_description = $request->input('site_description') ?? '';
        $facebook_url = $request->input('facebook_url') ?? '';
        $twitter_url = $request->input('twitter_url') ?? '';
        $instagram_url = $request->input('instagram_url') ?? '';
        $youtube_url = $request->input('youtube_url') ?? '';
        $footer_html = $request->input('footer_html') ?? '';
        $header_html = $request->input('header_html') ?? '';
        $logo_id = $request->input('logo_id') ?? '';

        // update all fields
        Option::update('site_title',$site_title);
        Option::update('site_description',$site_description);
        Option::update('facebook_url',$facebook_url);
        Option::update('twitter_url',$twitter_url);
        Option::update('instagram_url',$instagram_url);
        Option::update('youtube_url',$youtube_url);
        Option::update('footer_html',$footer_html);
        Option::update('header_html',$header_html);


        Option::update('logo_id',$logo_id);
        $logo = Media::find($logo_id);
        Option::update('logo_image',$logo);

        // redirect to index page
        return redirect()->route('admin.settings.index')->with('success','Site settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
