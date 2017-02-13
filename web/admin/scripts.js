//alert(document.getElementsByTagName('table')[0].getElementsByTagName('thead')[0].getElementsByTagName('th')[0].textContent);
                   
$(document).ready(function () {
    
   var table = $('#table_data').DataTable({
//        "columns": [
//            {"data": "id"},
//            {"data": "denomination"},
//            {"data": "caisse_prim"},
//            {"data": "n_agrement"},
//            {"data": "annee_scolaire"},
//            {"data": "code_grand_regime"}
//        ],
//        "bProcessing": true,
//        "bServerSide": true,
//        "sServerMethod": "GET",
//        "sAjaxSource": "controllerDatatable/getTable",
//        "ajax": {
//            url: 'controllerDatatable.php',
//            type: 'POST'
//        },
                "bProcessing": true,
	        "bServerSide": true,
	        "sServerMethod": "GET",
	        "sAjaxSource": "controllerAdmin/getTable",
	        "iDisplayLength": 10,
	        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	        "aaSorting": [[0, 'asc']],
	        "aoColumns": [
			{ "bVisible": true, "bSearchable": true, "bSortable": true },
			{ "bVisible": true, "bSearchable": true, "bSortable": true },
			{ "bVisible": true, "bSearchable": true, "bSortable": true }
                ],
        select: {
            style: 'multi',
            items: 'row'
        }
    });
    new $.fn.dataTable.Buttons( table, {
        name: 'selection',
        buttons: [
            'selected',
            'selectedSingle',
            'selectAll',
            'selectNone',
            'selectRows'
            //                    {extend: 'selectedSingle',
            //                        text: 'Log selected data',
            //                        action: function ( e, dt, button, config ) {
            //                            console.log( dt.row( { selected: true } ).data() );
            //                        }},
        ]
    } );    
    new $.fn.dataTable.Buttons( table, {
        name: 'alter',
        buttons: [
            {
                text: 'Ajouter',
                action: function () {
                    
//console.log(document.getElementsByTagName('table')[0].getElementsByTagName('thead')[0].getElementsByTagName('th')[0].textContent);

                    //                $('#trigger').trigger('click');
                    ////                alert('hi');
                }
            },
            {
                extend: 'selectedSingle',
                text: 'Editer',
                action: function () {
//                    var infos= table.row( { selected: true } ).data();
//                    dump(table.row( { selected: true } ).data());
//                    
//window.location.href = '/path'
//var landingUrl = "http://" + $window.location.host + "/login";
//$window.location.href = landingUrl;
//popup = window.open('/formDt', 'popup','width=400,height=400,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,');
//                        edit(table.row( { selected: true } ).data());
                        
                $('#trigger').trigger('click');
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

function columnsName() {
//console.log(document.getElementsByTagName('table')[0].getElementsByTagName('thead')[0].getElementsByTagName('th')[0].textContent);
	var colNames = new Array();
    	oTH = document.getElementsByTagName('table')[0].getElementsByTagName('thead')[0].getElementsByTagName('th'); 
//	
	for(var i in oTH){
//		oTH = oTH[ i ].getElementsByTagName('th');
		colNames = oTH[ i ].textContent;
	}
        return colNames;
//        var arr = [ "one", "two", "three", "four", "five" ];
//var obj = { one: 1, two: 2, three: 3, four: 4, five: 5 };
// 
//document.getElementById('users').each( arr, function( i, val ) {
//  $( "#" + val ).text( "Mine is " + val + "." );
};


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