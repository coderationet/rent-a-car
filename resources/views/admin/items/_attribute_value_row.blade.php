<tr class="attribbute-value-row" data-attribute-id="{{$item_attribute['id']}}">
    <td>
        {{$item_attribute['name']}}
    </td>
    <td>
        <select
            name="attribute_values[]"
            class="form-control multiple-attribute-values"

            @if($item_attribute['type'] == "multiselect")
                multiple=""
            @endif
            data-attribute-id="{{$item_attribute['id']}}">
            @foreach($item_attribute['values'] as $item_attribute_value)
                <option
                    value="{{$item_attribute_value['id']}}"
                    selected>{{$item_attribute_value['name']}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <!-- new value popup -->
        <button type="button"
                class="btn btn-primary btn-xs add-new-attribute-value"
                data-toggle="modal" data-target="#add-new-attribute-value-modal"
                id="add-new-attribute-button"
                data-attribute-id="{{$item_attribute['id']}}">
            <i class="fas fa-plus"></i> {{__('admin/attributes.add_new_value')}}
        </button>

{{--        @if(config('website.strict_attributes') === false)--}}
            <button type="button"
                    class="btn btn-danger btn-xs delete-attribute"
                    data-attribute-id="{{$item_attribute['id']}}">
                <i class="fas fa-trash"></i> {{__('admin/general.delete')}}
            </button>
{{--        @endif--}}
    </td>
</tr>

@pushonce('extra-footer')
    <script>
        $(function () {
            $(document).on('click', '.delete-attribute', function () {
                // delete attribute row
                $(this).parent().parent().remove();
            })
        })
    </script>
@endpushonce
