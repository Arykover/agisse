<!--    <div class ="container" id ="dataTable">-->
<table cellpadding="1" cellspacing="1" id="users" class="table table-striped table-bordered dataTable no-footer" width="100%">
<thead>
    <tr id="colName"> 
        <?php
	foreach ($columnsName as $c)
        {
        ?>
            <th> <?php echo $c['column_name'];?> </th>
        <?php
        }
        ?>
    </tr>
    </thead>
    <tbody>
        <?php
	foreach ($data as $d)
        {
        ?>        
            <tr>
             <?php
                foreach ($columnsName as $c)
                { 
                ?>
                     <td> <?php echo $d[$c['column_name']];?> </td>
                     <!--<td> <?php // echo $c['column_name'];?> </td>-->
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>