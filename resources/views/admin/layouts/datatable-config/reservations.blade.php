<script type="module">
    $(function () {
        $('#reservations').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "order": [[0, "desc"]],
            "ajax": {
                "url": "{{route('admin.reservations.data')}}",
                "type": "GET",
                "dataSrc": "data",
                "dataType": "json",
            },
            "language": datatable_tr,
            "columns": [
                {"data": "id"},
                {"data": "user_name"},
                {"data": "item_name"},
                {"data": "status"},
                {"data": "actions"}
            ],
        });
    });
</script>
