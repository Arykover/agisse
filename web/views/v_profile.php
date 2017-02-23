<form name="formProfile" method="POST" action="editUserProfile">
    <h3>
        Editer mon profil
    </h3>
    <?php
        $fName = $userInfo['nom'];
        $lName = $userInfo['prenom'];
        $mail = $userInfo['mail'];
        ?>
        <div class="form-group">
            <label for="lName">Nom :</label>
            <input type="text" class="form-control" id="lName" name="lastName" value="<?php echo $fName ?>" required>
        </div>
        <div class="form-group">
            <label for="fName">Prenom :</label>
            <input type="text" class="form-control" id="fName" name="firstName" value="<?php echo $fName ?>" required>
        </div> 
       
            <div class="form-group">
                <label for="mail">Email :</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $mail ?>">
            </div>


    <?php  if ($_SESSION['type'] == 'ELEVE' ){ ?>

            <input type="checkbox" name="togPwd" value="true" id="togPwd" >Modifier son mot de passe</p>

            <div id="editPwd" style='display:none;'>
                <div class="form-group">
                    <label for="pwd">Nouveau mot de passe :</label>
                    <input type="password" class="form-control" id="pwd" name="password" onkeyup="checkPass();
                            return false;">
                </div>
                <div class="form-group">
                    <label for="pwdconf">Confirmer Mot de passe :</label>
                    <input type="password" class="form-control" id="pwdConfirmation"  onkeyup="checkPass();
                            return false;">
                    <span id="confirmMessagePass" class="confirmMessagePass"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="pwdOld"><abbr title="Champs obligatoire pour effectuer toute modification">Mot de passe actuel :</abbr></label>
                <input type="password" class="form-control" id="pwdOld" name="passwordOld" required>
            </div>
            <button type="submit" id="sub" class="btn btn-default">valider</button> 

    <?php }
    else if($_SESSION['type'] == 'GESTION' ){ ?>
            
            <button type="submit" class="btn btn-default" name='pwdGen' value='false'>valider</button>
            <button type="submit" class="btn btn-default" name='pwdGen' value='true'>Generer un nouveau mot de passe</button> 
            
    <?php } ?>
</form>
