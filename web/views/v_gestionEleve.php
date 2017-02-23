







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

<div class='container'>
    <div class='container col-md-offset-2 col-md-8'>
        <div class="form-group">
            <input type="text" id="search" placeholder="Search..." class="form-control">
        </div>
        <br>
<table id="example" class="display" cellspacing="0" width="100%">
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
    </div>
</div>