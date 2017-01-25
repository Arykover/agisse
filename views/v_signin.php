

<div class="form-group">
    <label for="login">Identifiant :</label>
    <input type="text" class="form-control" id="login" name="login">
  </div>
  <div class="form-group">
    <label for="pwd">Mot de passe :</label>
    <input type="password" class="form-control" id="pwd" name="password">
  </div>
  <div class="form-group">
    <label for="pwdconf">Mot de passe :</label><span id="confirmMessagePass" class="confirmMessagePass"></span>
    <input type="password" class="form-control" id="pwdConfirmation"  onkeyup="checkPass(); return false;">
            
  </div>
  <div class="form-group">
    <label for="name">Nom :</label>
    <input type="text" class="form-control" id="pwd" name="name">
  </div>
  <div class="form-group">
    <label for="Fname">Prenom :</label>
    <input type="text" class="form-control" id="pwd" name="Fname">
  </div>
  <div class="form-group">
    <label for="email">Mail :</label>
    <input type="email" class="form-control" id="pwd" name="email">
  </div>
  <div class="form-group">
    <label for="pwdconf">Mail confirmation :</label>
    <input type="password" class="form-control" id="emailConfirmation"  onkeyup="checkMail(); return false;">
            <span id="confirmMessageMail" class="confirmMessageMail"></span>
  </div>
  <button type="submit" id="signsubmit" class="btn btn-default">valider</button> 

