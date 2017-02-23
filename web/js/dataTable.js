//$(document).ready(function () {
//
//   var table = $('#users').DataTable({
//        "processing": true,
//        "serverSide": true,
//        "ajax": {
//            "url": "js/dataTable.php",
//            "type": "POST",
//            "data": function ( d ) {
//            d.sTable =  sTable;
//            d.aColumns = aColumns;
//            }
//        },
//        select: {
//            style: 'multi',
//            items: 'row'
//        },
//        responsive:true
//    });   
//    });
    
$(document).ready(function(){
    $('#example').DataTable();
});
