<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{__('admin/attributes.attributes')}}
        </h3>
    </div>
    <div class="card-body">
        <div class="form-group">
{{--            @if(config('website.strict_attributes') === false)--}}
                <div class="row mb-3">
                    <div class="col-md-9">
                        <select name="attribute_id" id="attribute_id"
                                class="form-control">
                            <option
                                value="">{{__('admin/general.add_new')}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary w-100"
                                        id="add_attribute">
                                    {{__('admin/general.add_new')}}
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary w-100"
                                        id="create_attribute">
                                    {{__('admin/general.create_new')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
{{--            @endif--}}
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{__('admin/general.name')}}</th>
                        <th>{{__('admin/general.value')}}</th>
                        <th>{{__('admin/general.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody id="attribute_values_table">
                    @if($item_attributes)
                        @foreach($item_attributes as $item_attribute)
                            @include('admin.items._attribute_value_row', ['item_attribute' => $item_attribute])
                        @endforeach
                    @else
                        <tr class="no-record">
                            <td colspan="3"
                                class="text-center">{{__('admin/general.no_record')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@pushonce('extra-footer')

    <!-- Modal Create Attribute Value -->
    <div class="modal fade" id="add-new-attribute-value-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin/general.add_new')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="text" id="value" name="value" class="form-control">
                        <input type="hidden" value="" id="attribute-id-for-new-value">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('admin/general.close')}}</button>
                    <button type="button"
                            class="btn btn-primary add-new-value-action-button">{{__('admin/general.add_new')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Attribute -->
    <div class="modal fade" id="add-new-attribute-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin/general.add_new')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.item_attribute._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('admin/general.close')}}</button>
                    <button type="button"
                            class="btn btn-primary add-new-attribute-action-button">{{__('admin/general.add_new')}}</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* default input style  for select2 single select */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
            padding: 0.375rem 0.75rem !important;
            height: calc(1.5em + 0.75rem + 2px) !important;
            font-size: 0.9rem !important;
            line-height: 1.5 !important;
            border-radius: 0.2rem !important;
        }
    </style>
    <script>

        function select2_update() {

            $('#attribute_id').select2({
                ajax: {
                    url: '{{route('admin.item-attributes.ajax_data')}}',
                    dataType: 'json',
                    cache: false
                }
            });

            $('.multiple-attribute-values').select2({
                width: '100%',
                ajax: {
                    url: '{{route('admin.item-attribute-values.ajax_data')}}',
                    dataType: 'json',
                    data: function (params) {
                        let query = {
                            search: params.term,
                            attribute_id: $(this).data('attribute-id')
                        }
                        return query;
                    },
                    cache: false
                }
            });
        }

        $(function () {
            select2_update();
            $(document).on('click','.add-new-attribute-value',function () {
                $('#add-new-attribute-value-modal').find('#value').val('');
                $('#attribute-id-for-new-value').val($(this).data('attribute-id'));
            });

            $('.add-new-value-action-button').click(function () {
                $.post("{{route('admin.item-attribute-values.store')}}", {
                    attribute_id: $('#attribute-id-for-new-value').val(),
                    value: $(this).parent().parent().find('#value').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    response_type: "json"
                }, function (response) {
                    alert(response.msg);
                    // reset input value
                    $('#add-new-attribute-value-modal').modal('hide');
                });
            });
        });


        // Create new attribute
        $('#create_attribute').click(function () {
            $('#add-new-attribute-modal').modal('show');
        });

        $('.add-new-attribute-action-button').click(function () {
            $.post("{{route('admin.item-attributes.store')}}", {
                name: $(this).parent().parent().find('#name').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
                response_type: "json",
                type: $(this).parent().parent().find('#type').val(),
                slug : $(this).parent().parent().find('#slug').val(),
            }, function (response) {

                alert(response.msg);

                if (response.status !== "error") {
                    $('#add-new-attribute-modal').modal('hide');
                }

                // reset name value
                $('#add-new-attribute-modal').find('#value').val('');
            });
        });

        // create empty attribute row
        $('#add_attribute').click(function () {
            $.get("{{route('admin.items.attribute_value_row_html')}}?attribute_id=" + $('#attribute_id').val(), function (data) {
                // checl if element is exist
                if ($('#attribute_values_table').find('tr[data-attribute-id="' + $('#attribute_id').val() + '"]').length > 0) {
                    alert("{{__('admin/attributes.msg.attribute_already_exists')}}");
                    return;
                }
                $('#attribute_values_table').append(data);
                $('.no-record').remove();
                select2_update();
            });
        });
    </script>
@endpushonce
