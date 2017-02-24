
    
<input type="text" class="global_filter" id="global_filter">
 <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
 <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>

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
</table>
    <!--</div>-->