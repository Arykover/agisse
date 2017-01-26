<form name="formEditProfile" method="POST" action="profile">
     <h3>
        Editer mon profil
     </h3>
   <div class="form-group">
    <label for="lName">Nom :</label>
    <input type="text" class="form-control" id="lName" name="lastName" required>
  </div>
  <div class="form-group">
    <label for="fName">Prenom :</label>
    <input type="text" class="form-control" id="fName" name="firstName" required>
  </div>
  <div class="form-group">
      <label for="mail">Email :</label>
    <input type="email" class="form-control" id="mail" name="mail" required>
  </div>
    <input type="checkbox" name="togPwd" value="editPwd" id="togPwd" >Modifier son mot de passe</p>
    
    <div id="editPwd" style="visibility:hidden">
    <div class="form-group">
      <label for="pwdOld">Mot de passe actuel :</label>
      <input type="password" class="form-control" id="pwdOld" name="password">
    </div>
    <div class="form-group">
      <label for="pwd">Nouveau mot de passe :</label>
      <input type="password" class="form-control" id="pwd" name="password" onkeyup="checkPass(); return false;">
    </div>
    <div class="form-group">
      <label for="pwdconf">Confirmer Mot de passe :</label>
      <input type="password" class="form-control" id="pwdConfirmation"  onkeyup="checkPass(); return false;">
              <span id="confirmMessagePass" class="confirmMessagePass"></span>
    </div>
  </div>
  <button type="submit" class="btn btn-default" id="sub">Valider</button> 
</form>
