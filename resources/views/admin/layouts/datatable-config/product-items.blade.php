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
                {"data": "short_description"},
                {"data": "actions"}
            ],
            // ajax filtering for columns
            "initComplete": function () {
                this.api().columns([1]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).attr("placeholder", "Ürün Adı");
                    $(input).attr("class", "form-control form-control-sm");
                    $(input).appendTo($(column.header()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });
    });
</script>
