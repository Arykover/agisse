// fonction interdisant les couper/copier/coller dans les champs de confirmation


$(document).ready(function(){
      $('#pwdConfirmation').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
     $('#emailConfirmation').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
    });

// fonction verifiant que le champ password et confirmation sont identiques

function checkPass()
{
    //les 2 champs sont inserés dans des variables
    var pass1 = document.getElementById('pwd');
    var pass2 = document.getElementById('pwdConfirmation');
    //pareil pour le message de confirmation
    var message = document.getElementById('confirmMessagePass');
    //choix des couleurs pour validation et infirmation
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //definition des conditions de syntaxe du mot de passe
    var syntax = new RegExp("^(?=.{8,16})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$", "g");
    // test du mot de passe par rapport aux conditions
    if(syntax.test(pass1.value)){
            //comparation des valeurs des 2 champs 
            if(pass1.value == pass2.value){
                // Les champs correspondent, changement de la couleur, message de reussite 
                // et autorisation de la validation du formulaire 
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Mots de passes identiques";
                document.getElementById("sub").disabled = false;
            }else{
                // Les champs ne correspondent pas, changement de la couleur, message d'echec 
                // et interdiction de la validation du formulaire 
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Les mots de passe ne correspondent pas";
                document.getElementById("sub").disabled = true;
            }
        }
            else{
                pass2.style.backgroundColor = "#ffffff";
      message.style.color = badColor;
      message.innerHTML = "Le mot de passe doit faire entre 8 et 16 caracteres contenir une majuscule, une minuscule et un chiffre";
      document.getElementById("sub").disabled = true;
    }
    
} 

// fonction verifiant que le champ mail et confirmation sont identiques
// (fonctionne de maniere quasi identique a la precedente)

function checkMail()
{
    var pass1 = document.getElementById('email');
    var pass2 = document.getElementById('emailConfirmation');
    var message = document.getElementById('confirmMessageMail');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";

            if(pass1.value == pass2.value){
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "e-mail identiques"
                document.getElementById("sub").disabled = false;
            }else{
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Les e-mail ne correspondent pas";
                document.getElementById("sub").disabled = true;
            }
    

}

//fonction de conformite du numero de securite sociale avec l'annee de naissance
function checkSecu()
{
    var secu = document.getElementById('secu');
    var date = document.getElementById('dateNaiss');
    var message = document.getElementById('confirmMessageSecu');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    var result = false;
    
        if(secu.value.length == 15){
            if(secu.value.substring(1,3) == date.value.substring(2,4)){
                message.style.color = goodColor;
                message.innerHTML = "Conforme a la date de naissance";
                result = true;
            }
            else{
                message.style.color = badColor;
                message.innerHTML = "Non conforme a la date de naissance";
                result = false;
            }
        }
        else{
            message.innerHTML = " ";
            result = false;
        }
            return result;
}

// cette fonction vide le champ securite sociale au moment de la validation du formulaire
// si le champ n'est pas conforme a l'année de naissance

function SubmitCheckSecu()
{
    var secu = document.getElementById('secu');
    if(!checkSecu()){
        secu.value = '';
    }
}
    window.onload = function () {
        
        document.getElementById('togPwd').onChange = function () {
            
        // si la checkbox est cochée, la validation se bloque(debloquage avec la confirmation password)
        // l'entrée du champ ancien mot de passe devient REQUIRED
        // et les champs de mots de passe s'affichent
        
           if( document.getElementById('togPwd').checked == true ){
               
         document.getElementById("sub").disabled = true;
         document.getElementById("editPwd").style.display = 'block';
         checkPass(); //relance le checkPass pour eviter un blocage accidentel de la validation apres plusieurs check/uncheck
             }
             
        // si la checkbox n'est pas cochée, la validation se debloque
        // l'entrée du champ ancien mot de passe n'est plus REQUIRED
        // et les champs de mots de passe sont cachés
        
          else{
               document.getElementById("sub").disabled = false;
               document.getElementById("editPwd").style.display = 'none';
          }
        //document.getElementById("pwdOld").required = true;
       // expanded1.style.visibility = this.checked ? 'visible' : 'hidden';
        };
       
       
       
       document.getElementById('togMail').onchange = function () {
           if( document.getElementById('togMail').checked == true ){
         document.getElementById("mail").required = true;
         document.getElementById("editMail").style.display = 'block';
             }
          else{
               document.getElementById("mail").required = false;
               document.getElementById("editMail").style.display = 'none';
          }
    };
}
    
$("#search").keyup(function() {
    var value = this.value;

    $("#searchTable").find("tr").each(function(index) {
        if (index === 0) return;
        var id = $(this).find("td").text();
        $(this).toggle(id.indexOf(value) !== -1);
    });
});
    
