<table cellpadding="1" cellspacing="1" id="datatable" class="table table-striped table-bordered dataTable no-footer" width="100%">
    <thead>
        <tr id="colName"> 
            <?php
            //Liste le nom des champs dans l'entête du tableau
            foreach ($nomsColonnes as $c)
            {
            ?>
                <th> <?php echo $c['column_name'];?> </th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        //Liste toutes les données dans le tableau
	foreach ($lesDonnees as $d)
        {
        ?>        
            <tr>
             <?php
                foreach ($nomsColonnes as $c)
                { 
                ?>
                     <td> <?php echo $d[$c['column_name']];?> </td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>