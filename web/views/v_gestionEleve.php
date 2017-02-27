        <form method='POST' action="Fiche">
<table cellpadding="1" cellspacing="1" id="comptes"  class ="table table-bordered table-condensed table-responsive table-hover" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
            </tr>
        </thead>
        <tfoot>
            </tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
            </tr>
        </tfoot>
        <tbody>

            <?php
                foreach($data as $d){           
            ?>
            <tr>
                <td><button type='submit' formaction="Fiche" name='id' value ='<?php echo($d['id']); ?>' class='btn btn-primary'>Voir Fiche</button>
                <button type='submit' formaction="GestionProfil" name='id' value ='<?php echo($d['id']); ?>' class='btn btn-primary'>Voir Profil</button></td>
                <td><?php echo($d['nom']) ?></td>
                <td><?php echo($d['prenom']) ?></td>
                <td><?php echo($d['mail']) ?></td>
            </tr>
            
            <?php } ?>
            
            </tbody>
        </table>
</form>