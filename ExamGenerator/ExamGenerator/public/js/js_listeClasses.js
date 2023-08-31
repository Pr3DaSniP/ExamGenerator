jQuery(function () {

    let tableClasses;
    selectClasses();

    function selectClasses()
    {
        tableClasses = $('#dataTableClasses').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            },
            "ajax": {
                "url": "./getClasses",
                "type": "GET",
                "dataType": "json",
                "contentType": "application/json;charset=UTF-8",
                "dataSrc": function (data) {
                    if (Array.isArray(data) && data.length === 1 && data[0] === null) {
                        return [];
                    } else {
                        return data;
                    }
                }
            },
            "columns": [
                { "data": "Cursus" },
                { "data": "Niveau" }
            ]
    });

}
// Recharge les datatables
    function reload() {
        setTimeout(function() {
            tableClasses.ajax.reload();

        }, 1000);


    }

});
