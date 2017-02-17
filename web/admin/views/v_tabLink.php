<script type="text/javascript">
      var aColumns = new Array();
<?php
  foreach($columnsName as $c){
      echo("aColumns[aColumns.length] = '".$c[0]."';");
  }
  
  echo("var sTable = '".$sTable."';");
?>
 
</script>