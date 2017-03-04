//$(document).ready(function () {
//
//   var table = $('#users').DataTable({
//        "processing": true,
//        select: {
//            style: 'multi',
//            items: 'row'
//        },
//        responsive:true
//   });   
//    });
    
$(document).ready(function(){
 
    var table = $('#comptes').DataTable( {
          responsive: {
        details: {
            type: 'column'
        }
    },
        "select": true,
    buttons: [
        'copy', 'excel', 'csv'
    ]
} );
  
table.buttons().container()
    .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
    
});
