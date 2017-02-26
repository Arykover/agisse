</form>
<!-- Button trigger modal -->
<button id='trigger' type="submit" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style='display:none;' >
    Modal Trigger Button
</button>
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $sTable; ?></h4>
            </div>
            <div class="modal-body">
                <form id='FormDataTab' method='POST'
                    action='updateDataTable' >
                    <!--la table est générée dynamiquement
                        les noms des champs sont envoyés depuis le controleur
                        les valeurs des inputs sont insérés en javascript, en se basant sur la ligne selectionnée-->
                    <table class='table table-condensed'>
            <?php
            //si la table selectionnée contient un id auto-incrémenté
            //on ne l'affiche pas dans le formulaire
            //mais on récupère l'index et sa valeur
            if($hide)
            {
            ?>
                <input type='hidden' name="data[<?php echo $columnsName[0][0];?>]">
            <?php 
                unset($columnsName[0]);
            }
            foreach ($columnsName as $c)
            {
                //on définit le type de l'input en fonction du type que l'on a récupéré dans la base de données
                switch ($c['data_type'])
                {
                    case 'varchar': $type = 'text';break;
                    case 'int': $type = 'number';break;
                    default: $type = 'number';break;
                }
            ?>
                        <tr>
                            <td> <?php echo $c['column_name'];?> </td>
                            <td> <input type="<?php echo $type;?>" name="data[<?php echo $c['column_name'];?>]" value='' required></td>
                        </tr>
            <?php
            }
            ?>
                    </table>
            </div>
            <div class="modal-footer">
                <input type='hidden' name="hide" value=<?php echo $hide; ?>>
                <input type='hidden' name="table" value=<?php echo $sTable; ?>>
                <button type="button" class="btn btn-default" onclick="resetForm()">Vider les champs</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="save">Sauvegarder</button>
            </div>
            </form>
        </div>
    </div>
</div>