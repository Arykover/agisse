alert ('hi');
$(document).ready(function () {
    $('#users').DataTable({
        "columns": [
            {"data": "id"},
            {"data": "denomination"},
            {"data": "caisse_prim"},
            {"data": "n_agrement"},
            {"data": "annee_scolaire"},
            {"data": "code_grand_regime"}
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: 'dataTable.php',
            type: 'POST'
        }
    });
});