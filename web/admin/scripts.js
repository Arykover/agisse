$(document).ready(function () {
    // Initialise le datatable avec le tableau donné dans la page v_datatable.php
    var table = $('#datatable').DataTable({
        select: {
            style: 'multi',
            items: 'row'
        },
        responsive:true
    });
    
    // Initialise les boutons ajouter, editer et supprimer
    new $.fn.dataTable.Buttons( table, {
        name: 'edition',
        buttons: [
            {
                /*
                 * Définit les actions du bouton ajouter
                 * 
                 * Déselectionne toutes les lignes puis affiche un formulaire 
                 * vierge et affecte la valeur de la clé primaire à vide
                 */
                text: 'Ajouter',
                action: function () {
                    table.rows().deselect();
                    $('#afficherForm').trigger('click');
                    $('#formDatatable')[0].reset();
                    formElement = document.forms['formDatatable'].elements[1];
                    $(formElement).val( '' );
                }
            },
            {
                /*
                 * Définit les actions du bouton editer
                 * 
                 * Affiche un formulaire remplis avec les informations de la 
                 * ligne selectionnée
                 * 
                 * On ne peut cliquer sur ce bouton que si une ligne au moins a
                 * été selectionnée, dans le cas où plusieurs sont selectionnées,
                 * seule la première ligne est concernée
                 */
                extend: 'selectedSingle',
                text: 'Editer',
                action: function () {
                    $('#afficherForm').trigger('click');
                }
            },
            {
                /*
                 * Définit les actions du bouton supprimer
                 * 
                 * Supprime les lignes selectionnées en envoyant au controlleur 
                 * un formulaire caché contenant les 'id' des lignes selectionnées 
                 * ainsi que le nom de la table concernée
                 * 
                 * On ne peut cliquer sur ce bouton que si une ligne au moins a
                 * été selectionnée
                 */
                extend: 'selected',
                text: 'Supprimer',
                action: function () {
                    var ids = [];
                    $.each($("#datatable tr.selected"),function(){
                        idSelectionnes = ($(this).find('td:first').text().trim());
                        ids.push({
                            "id" : idSelectionnes
                        });
                    });
                    /*
                     * Créer puis envoi un formulaire vers le chemin donnée
                     * 
                     * Le formulaire décompose le tableau donnée puis créer de nouveaux 
                     * champs pour chaque ligne du tableau. Ils seront ensuite envoyés 
                     * en post vers le chemin donné
                     * 
                     * @params string path
                     *                  définis le chemin où est envoyé le formulaire
                     * @params array params
                     *                  tableau contenant les id des lignes selectionnées
                     * @params string method
                     *                  utilise par défaut la méthode post
                     */
                    function post(path, params, method) {
                        method = method || "post";
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
                        var tableName = $('input[name=nomTable]').val();
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "nomTable");
                        hiddenField.setAttribute("value", tableName);
                        form.appendChild(hiddenField);
                        document.body.appendChild(form);
                        form.submit();
                    };
                    post('../admin/suppLignesDataTable', ids);
                }
            }
        ]
    } );  
    
    // Affiche les boutons ajouter, editer et supprimer pour la page v_datatable
    table.buttons( ['edition'], null ).containers().appendTo( '.dataTable' );
    
    /*
     * Affiche le formulaire permettant d'ajouter ou modifier la ligne selectionnée
     * 
     * Remplis le formulaire avec les informations de la ligne selectionnée
     * Si c'est un ajout, on définit la variable ancienId à 'false'
     * Si c'est une mise à jour, on conserve la valeur de la clé primaire, avant 
     * modification par l'utilisateur, dans la variable ancienId
     * 
     * Simule un clic sur le bouton qui permet d'afficher le formulaire de la page
     * v_formDatatable.php
     */
    $('#afficherForm').on("click", function () {
        var lesDonnees = table.row( { selected: true } ).data();
        var formElement = '';
        formElement = document.forms['formDatatable'].elements[0];
        if($(lesDonnees).length > 0) 
            {$(formElement).val( lesDonnees[0] );}
        else
            {$(formElement).val( false );}
        for (var i in lesDonnees)
        {
            var a =i;
            i++;
            formElement = document.forms['formDatatable'].elements[i];
            $(formElement).val( lesDonnees[a] );
        }
    });
});

//EQUIVALENT D'UN VAR_DUMP en php, très utile !!!
function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre);
};