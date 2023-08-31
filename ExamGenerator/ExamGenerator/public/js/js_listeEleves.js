jQuery(function () {

    let tableEleves;
    selectEleves();


    function selectEleves()
    {
        tableEleves = $('#dataTableEleves').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            },
            "ajax": {
                "url": "./getEleves",
                "type": "GET",
                "dataType": "json",
                "dataSrc": function (data) {
                    if (Array.isArray(data) && data.length === 1 && data[0] === null) {
                        return [];
                    } else {
                        return data;
                    }
                }
            },
            "columns": [
                { "data": "ID" },
                { "data": "Nom" },
                { "data": "Prenom" },
                { "data": "Email" },
                { "data": "Moyenne" },
                { "data": "Classe" }
            ],
    });
}
// Recharge les datatables
    function reload() {
        setTimeout(function() {
            tableEleves.ajax.reload();
        }, 1000);


    }

});
