

<table cellpadding="1" cellspacing="1" id="comptes" class="table table-striped table-bordered dataTable no-footer"  width="100%">
        <thead>
            <tr>
               <?php foreach($data as $d){ 
                    $keys = array_keys($d); ?>
                            <tr>
                   <?php   $true =true;
                            foreach($keys as $k){
                      if($true){
            ?>

                <th><?php echo($k) ?></h>
                <?php }
                    $true = !$true;
                      } ?>
            </tr>
                        <?php } ?>
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
            <?php
                foreach($data as $d){ 
                    $keys = array_keys($d); ?>
                            <tr>
                   <?php   $true =true;
                            foreach($keys as $k){
                      if($true){
            ?>

                <td><?php echo($d[$k]) ?></td>
                <?php }
                       $true = !$true;
                      } ?>
            </tr>
            
            <?php } ?>
            </tbody>
        </table>