<form name="formEditProfile" method="POST" action="profile">
     <h3>
        Editer mon profil
     </h3>
   <div class="form-group">
    <label for="lName">Nom :</label>
    <input type="text" class="form-control" id="lName" name="lastName">
  </div>
  <div class="form-group">
    <label for="fName">Prenom :</label>
    <input type="text" class="form-control" id="fName" name="firstName">
  </div>
  <div class="form-group">
      <label for="mail">Email :</label>
    <input type="mail" class="form-control" id="mail" name="mail">
  </div>
  <div class="form-group">
    <label for="pwd">Nouveau mot de passe :</label>
    <input type="password" class="form-control" id="pwd" name="password">
  </div>
  <div class="form-group">
    <label for="pwdCheck">Retaper mot de passe :</label>
    <input type="password" class="form-control" id="pwdCheck" name="passwordCheck">
  </div>
  <button type="submit" class="btn btn-default">Submit</button> 
</form>
