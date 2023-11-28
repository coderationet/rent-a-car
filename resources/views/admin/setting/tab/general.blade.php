<form method="post"
      action="{{route('admin.settings.general-settings.update',1)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="site_title">{{__('admin/settings.seo_title')}}</label>
        <input type="text" name="site_title" id="site_title"
               class="form-control"
               value="{{$site_title}}">
    </div>
    <div class="form-group">
        <label
            for="description">{{__('admin/settings.seo_description')}}</label>
        <textarea name="site_description" id="site_description"
                  class="form-control">{{$site_description}}</textarea>
    </div>


    <div class="form-group">
        <label for="facebook_url">{{__('admin/settings.facebook_url')}}</label>
        <input type="text" name="facebook_url" id="facebook_url"
               class="form-control"
               value="{{$facebook_url}}">
    </div>
    <!-- Twitter -->
    <div class="form-group">
        <label for="twitter_url">{{__('admin/settings.twitter_url')}}</label>
        <input type="text" name="twitter_url" id="twitter_url"
               class="form-control"
               value="{{$twitter_url}}">
    </div>
    <!-- Instagram -->
    <div class="form-group">
        <label
            for="instagram_url">{{__('admin/settings.instagram_url')}}</label>
        <input type="text" name="instagram_url" id="instagram_url"
               class="form-control"
               value="{{$instagram_url}}">
    </div>
    <!-- Youtube -->
    <div class="form-group">
        <label for="youtube_url">{{__('admin/settings.youtube_url')}}</label>
        <input type="text" name="youtube_url" id="youtube_url"
               class="form-control"
               value="{{$youtube_url}}">
    </div>
    <!-- HTML Code For Footer -->
    <div class="form-group">
        <label for="footer_html">{{__('admin/settings.footer_html')}}</label>
        <textarea name="footer_html" id="footer_html"
                  class="form-control">{{$footer_html}}</textarea>
    </div>
    <!-- HTML Code For Header -->
    <div class="form-group">
        <label for="header_html">{{__('admin/settings.header_html')}}</label>
        <textarea name="header_html" id="header_html"
                  class="form-control">{{$header_html}}</textarea>
    </div>
    <div class="form-group">
        <label for="home_touch_up_image_id">
            {{__('admin/general.logo')}}
        </label>
        @include('admin.media_library._input',['input_name' => 'logo_id','relation' => 'image','item' => empty($logo_id) ? null : $logo_id])
    </div>


    <button type="submit"
            class="btn btn-primary">{{__('admin/general.update')}}
    </button>

</form>
