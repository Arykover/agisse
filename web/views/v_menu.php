<div class="banner-img">
    <img src ="../util/images/banner.png">
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
                            case 1: ?>
                    
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestion</a>
                <ul class="dropdown-menu">                
                             <li>
                                     <a href='GestionFiches' title=''>Fiches</a>
                             </li>
                             <li>
                                     <a href='GestionEleves' title=''>Comptes Eleves</a>
                             </li>
                             <li>
                                     <a href='GestionEleves' title=''>Comptes Gestionnaire</a>
                             </li>
                             <li>
                                     <a href='GestionClasses' title=''>Classes</a>
                             </li>
                             
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration</a>
                <ul class="dropdown-menu">
                            <li>
                                     <a href='GestionAffil' title=''>Affiliations</a>
                             </li>
                             <li>
                                     <a href='GestionRegimes' title=''>Regimes</a>
                             </li>
                             <li>
                                     <a href='GestionNationalite' title=''>Nationalités</a>
                             </li>
                             <li>
                                     <a href='GestionEtablissement' title=''>Etablissements</a>
                             </li>
                             <li>
                                     <a href='Reboot' title=''>Reinitialiser Application</a>
                             </li>
                             
                </ul>
              </li>
                    
                    <?php
                                break;
                            case 2:  ?>
                    
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestion</a>
                <ul class="dropdown-menu">                
                             <li>
                                     <a href='GestionFiches' title=''>Fiches</a>
                             </li>
                             <li>
                                     <a href='GestionEleves' title=''>Comptes Eleves</a>
                             </li>
                             <li>
                                     <a href='GestionClasses' title=''>Classes</a>
                             </li>
                             
                </ul>
              </li>
                    <li class="smenu">
                        <a href="profile" title="">Mon profil</a>
                    </li>
                    
                    <?php
                                break;
                            case 3:  ?>
                    
                    <li class="smenu">
                        <a href="Informations" title="">Ma fiche</a>
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
                    <?php } ?>
                    
                 
                    
                    <li class="smenu">
                        <a href="contact" title="Contact">Contact</a>
                    </li>
                    
              </ul>
            </div>
        </div>
    </nav>
<!-- Fin menu  -->

    <div class="container">
        <div class="jumbotron">