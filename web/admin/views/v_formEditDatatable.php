 
    <?php
//           $infos = ($_POST['infos']);
           $edit = ($_POST['edit']);
           $infos =json_encode( $edit );
           echo($infos);
//        $fName = $userInfo['nom'];
//        $lName = $userInfo['prenom'];
//        $mail = $userInfo['mail'];
        ?>
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
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <form id='FormDataTab' method='POST'
              action='updateDataTable' >
              <!--//style='display:none;'-->
        <table class='table table-condensed'>
            <input type='hidden' name="titles['id']" value=''>
            <?php 
            unset($columnsName[0]);
            foreach ($columnsName as $c)
            {
            ?>
            <tr>
                <td> <?php echo $c['column_name'];?> </td>
                <td> <input type='text' name="titles[<?php echo $c['column_name'];?>]" value=''></td>
            </tr>
            <?php
            }
//            echo(json_encode( $edit ));
            echo($infos);
            ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save" name='save' value="<?php echo $infos; ?>">Save changes</button>
        <!--<button type="button" class="btn btn-primary" id="save" name='save' value="validate">Save changes</button>-->
      </div>
          </form>
    </div>
  </div>
</div>
<?php // echo json_encode( $edit ); ?>