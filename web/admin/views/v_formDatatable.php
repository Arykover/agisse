</form>
<!-- Button trigger modal -->
<button id='afficherForm' type="submit" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style='display:none;' >
    Afficher le formulaire
</button>
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $nomTable; ?></h4>
            </div>
            <div class="modal-body">
                <form id='formDatatable' method='POST'
                    action='majDataTable' >
                    <!--la table est générée dynamiquement
                        les noms des champs sont envoyés depuis le controleur
                        les valeurs des inputs sont insérés en javascript, en se basant sur la ligne selectionnée-->
                    <table class='table table-condensed'>
                <input type='hidden' id='ancienId' name="ancienId">
            <?php
            //si la table selectionnée contient un id auto-incrémenté on ne 
            //l'affiche pas dans le formulaire
            //mais on récupère l'index et sa valeur
            if($champId)
            {
            ?>
                <input type='hidden' name="lesDonnees[<?php echo $nomsColonnes[0][0];?>]">
            <?php 
                unset($nomsColonnes[0]);
            }
            foreach ($nomsColonnes as $c)
            {
            ?>
                        <tr>
                            <td> <?php echo $c['column_name'];?> </td>
                            <td> <input type="text" name="lesDonnees[<?php echo $c['column_name'];?>]"required></td>
                        </tr>
            <?php
            }
            ?>
                    </table>
            </div>
            <div class="modal-footer">
                <input type='hidden' name="champId" value=<?php echo $champId; ?>>
                <input type='hidden' name="nomTable" value=<?php echo $nomTable; ?>>
                <button type="button" class="btn btn-default" onclick="this.form.reset()">Vider les champs</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="enregistrer">Sauvegarder</button>
            </div>
            </form>
        </div>
    </div>
</div>