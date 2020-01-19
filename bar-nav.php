
<header>
  <?php
    if (isset($_SESSION['login'])==false)
    {
    ?>
  

    <nav id="menu">
      <div class="nav1">
        

      </div>
      <div class="nav2">
        <a href="index.php"><h2>Accueil</h2></a>
        <a href="connexion.php"><h2>Connexion</h2></a>
        <a href="inscription.php"><h2>Inscription</h2></a>
      </div>
    </nav>
    
     <?php
    }
     elseif(isset($_SESSION['login'])==true)

    {
       
    ?>
  
    <nav id="menu">
      <div class="nav2">
        <a href="index.php"><h2>Accueil</h2></a>
        <a href="profil.php"><h2>Modification</h2></a>
        <a href="planning.php"><h2>Planning</h2></a>
        <a href="reservation-form.php"><h2>Réservation</h2></a>
        <a href="index.php?deconnexion=true"><h2>Déconnexion</h2></a>
      </div>
    </nav>
 
     <?php
                
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:index.php");
                   }
                }
    }
             
    ?>
</header>