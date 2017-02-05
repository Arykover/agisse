<?php echo (__DIR__.'../admin/scripts.js') ?>
    <div class ="container">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<table cellpadding="1" cellspacing="1" id="users" class="table table-striped table-bordered dataTable no-footer" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>denomination</th>
        <th>caisse_prim</th>
        <th>n_agrement</th>
        <th>annee_scolaire</th>
        <th>code_grand_regime</th>
    </tr>
    </thead>
</table>
    </div>
    </div>
<script type="text/javascript">
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
</script>