<div class="banner-img">
    <img src ="../web/images/banner.png">
</div>

<!--  Menu haut-->

    <nav class="navbar navbar-inverse" >

      <div class="container-fluid">
          
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                  
                    <li class="smenu">
                         <a href="home" title="Home">Accueil</a>
                    </li>
                    <?php if(isset($_SESSION['type'])){ 
                        switch($_SESSION['type']){
                           
                            case 'GESTION':  ?>
                                 
                             <li class="smenu">
                                     <a href='GestionFiches' title=''>Fiches</a>
                             </li>
                             <li class="smenu">
                                     <a href='GestionEleves' title=''>Comptes Eleves</a>
                             </li>
                             <li class="smenu">
                                     <a href='GestionDisciplines' title=''>Disciplines</a>
                             </li>
                             

                    <li class="smenu">
                        <a href="profile" title="">Mon profil</a>
                    </li>
                    
                    <?php
                                break;
                            case 'ELEVE':  ?>
                    
                    <li class="smenu">
                        <a href="Fiche" title="">Ma fiche</a>
                    </li>
                    <li class="smenu">
                        <a href="profile" title="">Mon profil</a>
                    </li>
                    
                      <?php
                                break;
                                }    ?>
                    
                    
                    <li class="smenu">
                        <a href="logOut" title="Log out">Se déconnecter</a>
                    </li>
                    
                    
                    <?php }
                    else{
                    ?>
                    <li class="smenu">
                        <a href="signIn" title="Sign in">S'inscrire</a>
                    </li>
                    <li class="smenu">
                        <a href="login" title="Log in">Se connecter</a>
                    </li> 
 
                    <li class="smenu">
                        <a href="contact" title="Contact">Contact</a>
                    </li>
                    <?php } ?>
              </ul>
            </div>
        </div>
    </nav>
<!-- Fin menu  -->

    <div class="container">
        <div class="jumbotron">