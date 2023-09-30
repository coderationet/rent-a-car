@include('admin.form._input',[
                                        'input_name'=>'name',
                                        'title'=>__('admin/general.name'),
                                        'placeholder'=>__('admin/attributes.insert_attribute_name'),
                                        'item' => $attribute ?? null
                                    ])
@include('admin.form._input',[
    'input_name'=>'slug',
    'title'=>__('admin/general.slug'),
    'placeholder'=>__('admin/attributes.insert_attribute_slug'),
    'item' => $attribute ?? null,
    'with_alerts' => true
])
<div class="form-group">
    <label for="type">{{__('admin/general.type')}}</label>
    <select id="type" name="type" class="form-control">
        <option
            @if(isset($attribute) && $attribute->type == "select")
                selected
            @endif
            value="select">{{__('admin/general.select')}}</option>
        <option
            @if(isset($attribute) && $attribute->type == "multiselect")
                selected
            @endif
            value="multiselect">{{__('admin/general.multiselect')}}</option>
    </select>
</div>
