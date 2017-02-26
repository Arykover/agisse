$(document).ready(function () {
    var table = $('#users').DataTable({
        language: {
            select: {
                rows: {
                    _: "Selected %d rows",
                    1: "Selected 1 row"
                }
            }
        },
        select: {
            style: 'multi',
            items: 'row'
        },
        responsive:true
    });
    new $.fn.dataTable.Buttons( table, {
        name: 'alter',
        buttons: [
            {
//                text: 'Ajouter',
//                action: function () {
//                    table.rows().deselect();
//                    $('#trigger').trigger('click');
//                    $('#FormDataTab')[0].reset();
//                    formElement = document.forms['FormDataTab'].elements[0];
//                    $(formElement).val( '' );
//                }
            },
            {
//                extend: 'selectedSingle',
                text: 'Editer',
                action: function () {
                    var infos =table.rows('.selected').data();
                    console.log(infos.length);
                    $('#trigger').trigger('click');
//                    if(infos.length < 1)
//                        resetForm();
                        
                    
                    
                }
            },
            {
                extend: 'selected',
                text: 'Supprimer',
                action: function () {
                    
                    //        var infos = table.rows( { selected: true } ).data();
                    //                    var infos =table.rows('.selected').data();
                    var ids = [];
                    $.each($("#users tr.selected"),function(){ //get each tr which has selected class
                        //        infos.push($(this).find('td').eq(0).text()); //find its first td and push the value
                        idsSelectedRows = ($(this).find('td:first').text()); //You can use this too
                        //push the object onto the array
                        ids.push({
                            "id" : idsSelectedRows
                        });
                    });
                    function post(path, params, method) {
                        method = method || "post"; // Set method to post by default if not specified.
                        // The rest of this code assumes you are not using a library.
                        // It can be made less wordy if you use one.
                        var form = document.createElement("form");    
                        form.setAttribute("method", method);
                        form.setAttribute("action", path);
                        for (var i=0; i<ids.length; i++)
                        {
                            for(var key in params[i]) {
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", "id["+i+"]");
                                hiddenField.setAttribute("value", params[i][key]);
                                form.appendChild(hiddenField);
                            }
                        }
                        
                        var tableName = $('input[name=table]').val();
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "table");
                        hiddenField.setAttribute("value", tableName);
                        form.appendChild(hiddenField);
                        document.body.appendChild(form);
                        form.submit();
                    };
//                    post('../admin/deleteDataTable', ids);
                    console.log(ids[0]['id']);
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
            formElement = document.forms['FormDataTab'].elements[i];
            $(formElement).val( infos[i] );
        }
    });
    
    $('#save').on("click", function () {
        var input = '';
        var edit = new Array();
        $('input[name^=titles]').each(function(){
            edit.push($(this).val());
            
        });
    });
});
function resetForm()
{
   $('#FormDataTab')[0].reset();
}
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