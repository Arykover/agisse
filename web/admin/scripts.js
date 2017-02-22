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
    //    dump($output);
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
                    table.rows().deselect();
                    $('#trigger').trigger('click');
                    $('#FormDataTab')[0].reset();
                     formElement = document.forms['FormDataTab'].elements[0];
                    $(formElement).val( false );
                }
            },
            {
                extend: 'selectedSingle',
                text: 'Editer',
                action: function () {
                    $('#trigger').trigger('click');
                    
                    
                }
            },
            {
                extend: 'selected',
                text: 'Supprimer',
                action: function () {
                    
                    //        var infos = table.rows( { selected: true } ).data();
                    //var infos =table.rows('.selected').data();
                    //        dump(infos);
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
    
    $('#trigger').on("click", function () {
        var infos = table.row( { selected: true } ).data();
        var formElement = '';
        for (var i in infos)
        {
            //     $('input[name^=titles]').val( infos[i] );
            formElement = document.forms['FormDataTab'].elements[i];
            $(formElement).val( infos[i] );
        }
    });
    
    $('#save').on("click", function () {
        var input = '';
        var edit = new Array();
        //            dump($('input[name^=titles]').each(function(){$(this).val();}));
        $('input[name^=titles]').each(function(){
            edit.push($(this).val());
            //    $.post( "views/v_formEditDatatable.php", { 'edit': edit } );
            
            $.ajax({
                url:'views/v_formEditDatatable.php',
                data: {edit:edit},
                type: 'post',
                success: function(data) {
                    alert(data);
                }
            });
        });
        //        var rowNode = table
        //                .row.add( [ 'Fiona White', 32, 'Edinburgh' ] )
        //                .draw()
        //                .node();
        //        
        //        $( rowNode )
        //                .css( 'color', 'red' )
        //                .animate( { color: 'black' } );
        //    });
        //    
    });
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
};