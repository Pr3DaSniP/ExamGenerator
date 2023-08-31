jQuery(function () {

    let tableUtilisateurs;
    selectUtilisateurs();

    // Ouverture des champs de la ligne pour édition
    $("#dataTableUtilisateurs").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {

        $(this).removeClass().addClass("fa fa-check");
        var $row = $(this).closest("tr").off("mousedown");
        var $tds = $row.find("td").not(':first').not(':last');

        $.each($tds, function(i, el) {
            if(i!=5 && i!=6 && i!= 4)
            {
                var txt = $(this).text();
                $(this).html("").append("<input type='text' value="+txt+">");
            }
            if(i==5)
            {
                $(this).find('select').removeAttr('disabled');
            }

        });

    });

    // Suppression d'une ligne
    $("#dataTableUtilisateurs").on("mousedown", "td .fas.fa-trash-alt", function(e) {

        var id = parseInt($(this).closest("tr").index());
        var idbdd = $("#dataTableUtilisateurs")[0].rows[id+1].cells[0].innerText;
        // Envoi en bdd
        deleteUtilisateur(idbdd);
        // Suppression de l'interface
        //tableListes.row($(this).closest("tr")).remove().draw();
        reload();

    })


   // $('<div class="addRow m-3"><button type="button" id="addRowUtilisateur" class="btn btn-success fas fa-plus-square"> Ajouter un utilisateur</button></div><br/>').insertAfter('#dataTableUtilisateurs');
    // Ajout d'une liste
    $('#addRowUtilisateur').click(function() {
        let nbRow = $('#dataTableUtilisateurs')[0].tBodies[0].rows.length;
        let lastIndex = parseInt($('#dataTableUtilisateurs')[0].tBodies[0].rows[nbRow-1].cells[0].innerText);
        if($('#dataTableUtilisateurs')[0].tBodies[0].rows[0].childNodes.length == 1){
            // premier
            lastIndex = 0
        }
        tableUtilisateurs.row.add({"Identifiant": "", "Nom": "","Prenom": "","Email": "","Date Naissance": "", "Date Creation": "", "Role": "", "Actions": "<i id=btEditSave"+lastIndex+" class=\"fa fa-pencil-square\" aria-hidden=\"true\"></i> <i class=\"fas fa-trash-alt\" aria-hidden=\"true\"></i><i id=\"Ouvrir\" class=\"far fa-folder-open ml-2\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Ouvrir\" aria-hidden=\"false\"></i>"}).draw();

        // Rendre modifiables les champs
        $tds = $('#dataTableUtilisateurs')[0].tBodies[0].rows[0].childNodes;
        $.each($tds, function(i, el) {
            if(i!=5 && i != 6 && i!=7 && i!=0){
                let txt = $(this).text();
                $(this).html("").append("<input type='text' value="+txt+">");
            }
            if(i==7) {
                $('#btEditSave'+lastIndex).removeClass("fa-pencil-square" ).addClass("fa fa-check" );
            }
        });
    });

    // Sauvegarde de la ligne
    $("#dataTableUtilisateurs").on('mousedown.save', "i.fa.fa-check", function(e) {

        $(this).removeClass().addClass("fa fa-pencil-square");
        var $row = $(this).closest("tr");
        var idRow = $(this).closest("tr").index();
        var $tds = $row.find("td").not(':first').not(':last');

        $.each($tds, function(i, el) {
            var txt = $(this).find("input").val()
            $(this).html(txt);
        });

        // Envoi en bdd
        let id = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[0].innerText;
        let nom = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[1].innerText;
        let prenom = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[2].innerText;
        let email = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[3].innerText;
        let dateNaissance = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[4].innerText;
        let role = $('#dataTableUtilisateurs')[0].tBodies[0].rows[idRow].cells[6];
        let ld = $(role).find('select');
        let roleId = $(ld).val();
        if(id == '' && nom != '' && prenom != '' && email != '' && dateNaissance != ''){
            // INSERT
            insertUtilisateur(nom,prenom,email,dateNaissance);
            reload();
        }
        else {
            // UPDATE
            updateUtilisateur(id,nom,prenom,email,dateNaissance,roleId);
            reload();
        }

    });

    $("#dataTableListes").on('mousedown', "#selectbasic", function(e) {
        e.stopPropagation();
    });

/*
// Ajoute un nouvel utilisateur en base de données
function insertUtilisateur(nom,prenom,email,dateNaissance){
    $.ajax({
        type : 'POST',
        url : "./insertUtilisateur",
        contentType: 'application/json;charset=UTF-8',
        data : JSON.stringify({'nom':nom, 'prenom':prenom, 'email':email,'dateNaissance':dateNaissance})
    });
}
*/

    //Modifie une liste en bdd
    function updateUtilisateur(id,nom,prenom,email,dateNaissance,roleId){
        $.ajax({
            type : 'POST',
            url : "./updateUtilisateur",
            contentType: 'application/json;charset=UTF-8',
            dataType: 'json',
            data : JSON.stringify({'id':id, 'nom':nom, 'prenom':prenom, 'email':email,'dateNaissance':dateNaissance, 'roleId':roleId}),
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Efface une liste en bdd
    function deleteUtilisateur(id){
        $.ajax({
            type : 'POST',
            url : "./deleteUtilisateur",
            contentType: 'application/json;charset=UTF-8',
            data : JSON.stringify({'id':id})
        });
    }


    function createRoleDropdown(selectedRoleId, disabled) {
        // Liste des options pour la liste déroulante
        var roleOptions = [
            { id: 1, label: "Enseignant" },
            { id: 2, label: "Administrateur" },
            { id: 3, label: "Elève" }
        ];

        // Générez le code HTML de la liste déroulante
        var html = '<select' + (disabled ? ' disabled' : '') + '>';
        roleOptions.forEach(function(option) {
            var selected = option.id == selectedRoleId ? 'selected' : '';
            html += '<option value="' + option.id + '" ' + selected + '>' + option.label + '</option>';
        });
        html += '</select>';

        return html;
    }


    function selectUtilisateurs()
{
    tableUtilisateurs = $('#dataTableUtilisateurs').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
        },
        "ajax": {
            "url": "./getUtilisateurs",
            "type": "GET",
            "dataType": "json",
            "dataSrc": function (data) {
                // Vous pouvez manipuler les données renvoyées ici si nécessaire.
                return data;
            }
        },
        "columns": [
            { "data": "Identifiant" },
            { "data": "Nom" },
            { "data": "Prenom" },
            { "data": "Email" },
            { "data": "Date Naissance" },
            { "data": "Date Creation" },
            { "data": "Role",
                "render": function (data, type, row, meta) {
                    // Récupérez l'ID du rôle actuel
                    var roleId = row.Role;

                    // Générez le code HTML de la liste déroulante avec la valeur du rôle actuel sélectionnée
                    var html = createRoleDropdown(roleId, true);

                    // Retournez le code HTML pour afficher la liste déroulante
                    return html;
                }
            },

            { "data": "Actions" }
        ],
    });
}
// Recharge les datatables
    function reload() {
        setTimeout(function() {
            tableUtilisateurs.ajax.reload();
        }, 1000);


    }

});
