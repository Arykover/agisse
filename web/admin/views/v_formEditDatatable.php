 
    <?php
//        $fName = $userInfo['nom'];
//        $lName = $userInfo['prenom'];
//        $mail = $userInfo['mail'];
        ?>
        <input type='hidden' name='id' value='<?php echo 'hehe' ?>'>
    <button type="submit" id="sub" class="btn btn-default">valider</button>
    <!--onclick="SubmitCheckSecu()-->
</form>
<!-- Button trigger modal -->
<button id='trigger' type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style='display:none;'>
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
          <form id='FormDataTab' method='POST' action='update' style='display:none;'>
        <table class='table table-condensed'>
            <tr>
                <td> X : </td>
                <td><?php echo 'hehe' ?></td>
            </tr>
            <tr>
                <td> X : </td>
                <td><?php echo 'hehe' ?></td>
            </tr>
            <tr>
                <td> X : </td>
                <td><?php echo 'hehe' ?></td>
            </tr>
            <tr>
                <td> X : </td>
                <td><?php echo 'hehe' ?></td>
            </tr>
        </table>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>