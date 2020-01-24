<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="reservation.css">
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
                <img height="120" src="https://www.freeiconspng.com/uploads/bluee-target-icon-6.png"> 
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
        <figure class="paint">
        	<img  height="640" width ="650" src="img/arena2.png">
        </figure>
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
    <footer>
        <h2><b>Contact</b></h2>
        <h3>TERRAIN PAINTBALL MARSEILLE</h3>
        <p>15 Chemin du bois de l’Aumône - Via D4A EOURES
          13011 Marseille</p>
        <p>Téléphone : <b>04 69 00 16 84</b></p>
        <a href="https://www.paintballmarseille.com/site/pdf/INVIT%20ANNIV%203.pdf"> <button type="button" class="contact">TELECHARGER VOTRE INVITATION</button></a>
        <a href="https://www.google.fr/maps/dir/IKEA+Marseille+La+Valentine,+ZAC+la+Ravelle,+Avenue+Fran%C3%A7ois+Chardigny,+13011+Marseille/Chemin+du+Bois+de+l'Aum%C3%B4ne,+13011+Marseille/@43.2925951,5.4851795,14z/data=!4m15!4m14!1m5!1m1!1s0xd552856d05bc761:0x571bcb03362f186a!2m2!1d5.480252!2d43.293167!1m5!1m1!1s0x12c9bcf4cf807b1b:0x996fe742a9f9e5f2!2m2!1d5.5232904!2d43.2933535!3e0!5i2"> <button type="button" class="contact">Plan d'accés</button></a>
    </footer>

 </body>
</html>