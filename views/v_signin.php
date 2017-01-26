

<form name="formSignIn" method="POST" action="inscription">
    

  <div class="form-group">
    <label for="name">Nom :</label>
    <input type="text" class="form-control" id="Lname" name="Lname" required>
  </div>
  <div class="form-group">
    <label for="Fname">Prenom :</label>
    <input type="text" class="form-control" id="Fname" name="Fname" required>
  </div>
  <div class="form-group">
    <label for="email">Mail :</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="emailConfirmation">Confirmer Mail :</label>
    <input type="email" class="form-control" id="emailConfirmation"  onkeyup="checkMail(); return false;" required>    
    <span id="confirmMessageMail" class="confirmMessageMail"></span>    
  </div>
    <div class="form-group">
      <label for="pwd">Mot de passe :</label>
      <input type="password" class="form-control" id="pwd" name="password" onkeyup="checkPass();return false;" required>
    </div>
  <div class="form-group">
    <label for="pwdconf">Confirmer Mot de passe :</label>
    <input type="password" class="form-control" id="pwdConfirmation"  onkeyup="checkPass(); return false;" required>
            <span id="confirmMessagePass" class="confirmMessagePass"></span>
  </div>
  <button type="submit" id="sub" class="btn btn-default">valider</button> 
</form>

