//alert(document.getElementsByTagName('table')[0].getElementsByTagName('thead')[0].getElementsByTagName('th')[0].textContent);
             
$(document).ready(function () {
   var table = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "datatable.php",
            "type": "POST",
            "data": function ( d ) {
            d.sTable =  sTable;
            d.aColumns = aColumns;
            }
        },
        select: {
            style: 'multi',
            items: 'row'
        },
        responsive:true
    });
    new $.fn.dataTable.Buttons( table, {
        name: 'selection',
        buttons: [
            'selected',
            'selectedSingle',
            'selectAll',
            'selectNone',
            'selectRows'
        ]
    } );    
    new $.fn.dataTable.Buttons( table, {
        name: 'alter',
        buttons: [
            {
                text: 'Ajouter',
                action: function () {
                    $('#trigger').trigger('click');
                }
            },
            {
                extend: 'selectedSingle',
                text: 'Editer',
                action: function () {
//                    console.log(table.row( { selected: true } ).data());
                    var infos = [];
                    infos= table.row( { selected: true } ).data();
                    dump(infos);
                    
                    $.ajax({
                        url: "views/v_formEditDatatable.php",
//                        data: infos,
                        data: 'sTable=' + sTable,
                        type: 'post'
//                        success: function(data) {
//                            alert(data);
//                        }
                    });
                    
//                    $.post( "maintenance.php", { 'infos': infos } );
                    
//                    $.ajax({
//                        type: "POST",
//                        data: {infos:infos},
//                        url: "maintenance.php",
//                        success: function(msg){
//                            $('.answer').html(msg);
//                        }
//                    });
                    
//                    $.ajax({
//                        type: 'POST',
//                        url: 'views/v_formEditDatatable.php',
////                      data: 'infos=' + infos
//                        "data": function ( d ) {
//                            d.infos = 'infos=' + infos;
//                        }
//                        
//                        var login = $("#result1").html();
//    $.post("views/v_formEditDatatable.php", {'infos': infos}, function(response) {
//         console.log(response);
//         $.post("views/v_formEditDatatable.php", {'infos': infos}, function( data ) {
//  $( ".result" ).html( data );
         
//                        data: function ( d ) {
//                        d.infos = infos;
//                        }
//                    });
                    $('#trigger').trigger('click');
//         document.getElementById("FormDataTab").style.display = 'block';
//
//                    var infos= table.row( { selected: true } ).data();
//                    dump(table.row( { selected: true } ).data());
//                    
//window.location.href = '/path'
//var landingUrl = "http://" + $window.location.host + "/login";
//$window.location.href = landingUrl;
//popup = window.open('/formDt', 'popup','width=400,height=400,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,');
//                        edit(table.row( { selected: true } ).data());
                        
//                $('#trigger').trigger('click');
                }
            },
            {
                extend: 'selected',
                text: 'Supprimer',
                action: function () {
                    table.rows().deselect();
                }
            },
            {
				text: 'Actualiser',
				action: function () {
					table.ajax.reload();
				}
			}
        ]
    } );  
    table.buttons( ['alter'], null ).containers().appendTo( '.dataTable' );
});


//EQUIVALENT D'UN VAR_DUMP en php, très utile !!!
function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

//    alert(out);

    // or, if you wanted to avoid alerts...

    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre);
}
