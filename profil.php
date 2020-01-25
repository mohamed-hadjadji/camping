<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="camping.css">
    <title>Profil</title>
</head>
<body class="bodyc">

  <?php
  session_start();
  include("bar-nav.php");
  if (isset($_SESSION['login']))
  {
    $connexion = mysqli_connect("localhost","root","","gestioncamping");

    $requete = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
    $req = mysqli_query($connexion, $requete);
    $data = mysqli_fetch_assoc($req);
  ?>
    <section id="connexion">
        
      <div id="main" class="container">   
            <form name="loginform" id="loginform" action="#" method="post" class="wpl-track-me"> 
                <p class="login-username">
                    <label for="user_login">Username</label> 
                    <input type="text" id="user_login" class="input" placeholder="New Username" value="<?php echo $data['login']?>" size="20" name="login"/> 
                </p> 
                <p class="login-password"> 
                    <label for="user_pass">Password</label>
                    <input type="password" name="mdp" id="user_pass" class="input" placeholder="New Password" value="<?php echo $data['password']?>" size="20"/> 
                </p>    

                <p class="login-submit"><input type="submit" name="Modifier" id="submit" class="button-primary" value="Modifier" />
                    <input type="hidden" name="redirect_to" value="#"/>
                </p>  
           </form>
         </div>
        
   </section>
  <?php

    if (isset($_POST['Modifier']))
    {


      $login = $_POST['login'];
      $passe = password_hash($_POST["mdp"], PASSWORD_DEFAULT, array('cost' => 12));

      $requete2 = "UPDATE utilisateurs SET login = '$login', password = '$passe' WHERE login = '".$_SESSION['login']."'";
      $query2=mysqli_query($connexion,$requete2);
      session_unset();
      header("location:connexion.php?reconnect=1");
    }
  }
  else 
  {
  ?>
    <section id="notcon">
      <p>Veuillez vous connecter pour accéder à votre page !</p>
    </section>
        <?php
  }
  
include("footer.php");
?>
 
  
</body>
</html>

        
