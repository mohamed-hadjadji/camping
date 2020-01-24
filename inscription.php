<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="camping.css">
	<title>Inscription</title>
</head>
<body class="bodyc">

	<?php
    session_start();
    include("bar-nav.php");
     
     $connexion =  mysqli_connect("localhost","root","","gestioncamping");
     if ( !isset($_SESSION['login']) )
    {
    ?>
    <section id="connexion">

        <div id="main" class="container">   
            <form name="loginform" id="loginform" action="#" method="post" class="wpl-track-me"> 
                <p class="login-username">
                    <label for="user_login">Username</label> 
                    <input type="text" id="user_login" class="input" placeholder="Username" value="" size="20" name="login" required/> 
                </p> 
                <p class="login-password"> 
                    <label for="user_pass">Password</label>
                    <input type="password" name="mdp1" id="user_pass" class="input" placeholder="Password" value="" size="20" required/> 
                </p>
                <p class="login-password"> 
                    <label for="user_pass">Password</label>
                    <input type="password" name="mdp2" id="user_pass" class="input" placeholder="Confirmer Password" value="" size="20" required/> 
                </p>       

                <p class="login-submit"><input type="submit" name="connexion" id="submit" class="button-primary" value="Log in" />
                    <input type="hidden" name="redirect_to" value="#"/>
                </p>    
                 <?php


        if (isset($_POST['connexion']))
       {
            $login = $_POST['login'];
	        $mdp= password_hash($_POST["mdp1"], PASSWORD_DEFAULT, array('cost' => 12));
	        if ($_POST['mdp1']==$_POST['mdp2'])
            {
            $requet="SELECT* FROM utilisateurs WHERE login='".$login."'";
            $query2=mysqli_query($connexion,$requet);
            $resultat=mysqli_fetch_all($query2);
            $trouve=false;
            foreach ($resultat as $key => $value) 
            {
            if ($resultat[$key][1]==$_POST['login'])
            {
               $trouve=true;
               echo "<p class='erreur'><b>Login déja existant!!</b></p>";
            }
           }
           if ($trouve==false)
           {
            $sql = "INSERT INTO utilisateurs (login,password)
                VALUES ('".$login."','".$mdp."')";
            $query=mysqli_query($connexion,$sql);
            header('location:connexion.php');
            }
           }
           else
           {
              echo "<p class='erreur'><b>Les mots de passe doivent être identique!</b></p>";
           }
        }

    ?>
        
        </form>
    </div>
        
    </section>
    <?php
    }
    else 
    {
    ?>
    <section id="notcon">
      <p>Vous êtes déjà connecté impossible de s'inscrire !!</p>
    </section>
        <?php
    }
    ?>
  

 </body>
</html>