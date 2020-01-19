<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="">
	<title>Inscription</title>
</head>
<body class="bodyi">

	<?php
    session_start();
    include("bar-nav.php");
     
     $connexion =  mysqli_connect("localhost","root","","gestioncamping");
     if ( !isset($_SESSION['login']) )
    {
    ?>
    <section id="connexion">
        <form class="form" method="POST" action="">
            <main class="connect">
             
                <h2>INSCRIPTION</h2>
            </main>
            <main class="login">
        
        
                 <label><b>LOGIN</b></label>
                 <input type="text" name="login" placeholder="Entrez votre Login" required><br/>
                 <label><b>PASSWORD</b></label>
                 <input type="password" name="mdp1" placeholder="Entrez votre mot de passe" required><br/>
                 <label><b>CONFIRMER PASSWORD</b></label>
                 <input type="password" name="mdp2" placeholder="Confirmez votre mot de passe" required><br/> 
                 <input align="center" type="submit" value="VALIDER" name="connexion"><br>
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
            </main>
        
        </form>
        
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