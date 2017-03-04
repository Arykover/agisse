
<form method='POST'>
<table cellpadding="1" cellspacing="1" id="comptes" class="table table-striped table-bordered dataTable no-footer table-hover"  width="100%">
        <thead>
            <tr>
                <th></th>
                 <?php
                 
                    $keys = array_keys($data[0]); foreach($keys as $k){
                      if($k == 'id'){
            ?>
                <th>modif fiche</th>
                      <?php } else{ ?>
                <th><?php echo($k) ?></th>
                    <?php } }?>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $d){ 
                    $keys = array_keys($d); ?>
                            <tr>
                   <?php   foreach($keys as $k){
                      if($k == 'id'){
            ?>
                                <td><button type='button' class='btn btn-primary'>Details</button></td>
                <td><button type='submit' formaction="Fiche" name='id' value ='<?php echo($d['id']); ?>' class='btn btn-primary'>Modifier</button></td>
                      <?php } else{ ?>
                
                <td><?php echo($d[$k]) ?></td>
                       <?php }
                      } ?>
            </tr>
            
            <?php } ?>
            </tbody>
        </table>
</form>