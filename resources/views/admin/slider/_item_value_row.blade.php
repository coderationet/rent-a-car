<tr class="slider-item-row">
    <td>
        @include('admin.media_library._input',[
            "input_name" => $slider_item_index . "_input_file_desktop",
            "relation" => "desktop",
            "multiple_file" => false,
            "item" => $item ?? null,
                   "no_script" => true,
        ])
    </td>

    <td>
        @include('admin.media_library._input',[
                   "input_name" => $slider_item_index . "_input_file_mobile",
                   "relation" => "mobile",
                   "multiple_file" => false,
                   "item" => $item ?? null,
                   "no_script" => true
               ])
    </td>

    <td>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">{{__('admin/general.title')}}</label>
                            <input type="text" class="form-control"
                                   name="{{$slider_item_index}}_input_title"
                                   value="{{isset($item) ? $item->{$slider_item_index.'_input_title'} : ''}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sub_title">{{__('admin/general.sub_title')}}</label>
                            <input type="text" class="form-control" name="{{$slider_item_index}}_input_sub_title"
                                   value="{{isset($item) ? $item->{$slider_item_index.'_input_sub_title'} : ''}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="link_text">{{__('admin/general.link_text')}}</label>
                        <input type="text" class="form-control" name="{{$slider_item_index}}_input_link_text"
                               value="{{isset($item) ? $item->{$slider_item_index.'_input_link_text'} : ''}}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="link">{{__('admin/general.link')}}</label>
                        <input type="text" class="form-control" name="{{$slider_item_index}}_input_link"
                               value="{{isset($item) ? $item->{$slider_item_index.'_input_link'} : ''}}"
                               required>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
