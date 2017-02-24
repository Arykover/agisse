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
        <table class='table table-condensed'>
            <?php
            if($hide)
            {
                
            ?>
            <input type='hidden' name="primaryKey[<?php echo $columnsName[0][0];?>]" value=false>
            <?php 
            unset($columnsName[0]);
            }
            foreach ($columnsName as $c)
            {
            ?>
            <tr>
                <td> <?php echo $c['column_name'];?> </td>
                <td> <input type='text' name="data[<?php echo $c['column_name'];?>]" value='' required></td>
            </tr>
            <?php
            }
            ?>
        </table>
      </div>
      <div class="modal-footer">
          <input type='hidden' name="table" value=<?php echo $sTable; ?>>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Save changes</button>
      </div>
          </form>
    </div>
  </div>
</div>