
<table cellpadding="1" cellspacing="1" id="users" class="table table-striped table-bordered dataTable no-footer" width="100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
                <th>Fiche</th>
                <th>Profil</th>
            </tr>
        </thead>
        <tfoot>
            </tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
                <th>Fiche</th>
                <th>Profil</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
            <?php
                foreach($comptes as $c){           
            ?>
            <tr>
                <td><?php echo($c['nom']) ?></td>
                <td><?php echo($c['prenom']) ?></td>
                <td><?php echo($c['mail']) ?></td>
                <td><?php echo($c['nom']) ?></td>
                <td><?php echo($c['nom']) ?></td>
            </tr>
            
            <?php } ?>
            </tbody>
        </table>