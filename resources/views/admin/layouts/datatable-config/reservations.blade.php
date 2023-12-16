<script type="module">
    $(function () {
        $('#reservations').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "lengthChange": true,
            "pageLength": 25,
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
