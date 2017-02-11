    <div class ="container" id ="dataTable">
<table cellpadding="1" cellspacing="1" id="users" class="table table-striped table-bordered dataTable no-footer" width="100%">
<thead>
    <tr id="colName"> 
        <?php
	foreach ($columnsName as $c)
        {
        ?>
            <th> <?php echo $c['column_name'];?> </th>
        <?php
        }
        ?>
<!--        <th>id</th>
        <th>denomination</th>
        <th>caisse_prim</th>
        <th>n_agrement</th>
        <th>annee_scolaire</th>
        <th>code_grand_regime</th>-->
    </tr>
    </thead>
</table>
    </div>
    </div>