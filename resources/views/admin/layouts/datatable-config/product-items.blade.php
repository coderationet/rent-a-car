<script type="module">
    $(function () {
        $('#items').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [[0, "desc"]],
            "ajax": {
                "url": "{{route('admin.items.data')}}",
                "type": "GET",
                "dataSrc": "data",
                "dataType": "json",
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
