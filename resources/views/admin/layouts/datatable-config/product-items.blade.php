<script type="module">
    $(function () {
        $('#items').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [[0, "desc"]],
            "ajax": {
                "url": "{{route('admin.data-table.data')}}",
                "type": "GET",
                "dataSrc": "data",
                "dataType": "json",
                "data" : {
                    "table_name" : "items",
                    "read_permission" : {{\App\Helpers\PermissionHelper::checkIfUserHasPermission(\App\Enums\PermissionEnum::ITEMS_READ) ? 1 : 0}},
                    "update_permission" : {{\App\Helpers\PermissionHelper::checkIfUserHasPermission(\App\Enums\PermissionEnum::ITEMS_UPDATE) ? 1 : 0}},
                    "delete_permission" : {{\App\Helpers\PermissionHelper::checkIfUserHasPermission(\App\Enums\PermissionEnum::ITEMS_DELETE) ? 1 : 0}},
                }
            },
            "language": datatable_tr,
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "description"},
                {"data": "actions"}
            ],
        });
    });
</script>
