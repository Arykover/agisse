$(document).ready(function(){
      $('#pwdConfirmation').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
     $('#emailConfirmation').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
    });

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
                message.innerHTML = "Mots de passes identiques"
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
    }
    
} 

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
                document.getElementById("signsubmit").disabled = false;
            }else{
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Les e-mail ne correspondent pas";
                document.getElementById("signsubmit").disabled = true;
            }
    

}


    window.onload = function () {
        var checkbox = document.getElementById('togPwd')
        var expanded1 = document.getElementById("editPwd");
        checkbox.onchange = function () {
        expanded1.style.visibility = this.checked ? 'visible' : 'hidden';
    };}
    
    
 
