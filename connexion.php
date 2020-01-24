<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="reservation.css">
    <title>Connexion</title>
</head>
<body class="bodyc">


	<?php
	session_start();
	include("bar-nav.php");
    if ( !isset($_SESSION['login']) )
    {
	    if(isset($_POST['login']) && isset($_POST['password']))
        {
   	        $connexion = mysqli_connect ("localhost", "root", "", "gestioncamping");

   	        $login = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['login']));
            $password = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['password']));

            if($login !== "" && $password !== "")
            {
                $requete = "SELECT count(*) FROM utilisateurs where
                login = '".$login."' ";
                $exec_requete = mysqli_query($connexion,$requete);
                $reponse      = mysqli_fetch_array($exec_requete);
                $count = $reponse['count(*)'];

                $requete4 = "SELECT * FROM utilisateurs WHERE login='".$login."'";
                $exec_requete4 = mysqli_query($connexion,$requete4);
                $reponse4 = mysqli_fetch_array($exec_requete4);

                if( $count!=0 && $_SESSION['login'] !== "" && password_verify($password, $reponse4[2]) )
                {
            
                $_SESSION['login'] = $_POST['login'];
                $user = $_SESSION['login'];
                header('Location: index.php');
                }
                else
                {
                header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
                }
            }
        }
        ?>
     <section id="connexion">
         <form class="form" action="" method="POST">
        	<main class="connect">
                <img height="120" src="https://www.freeiconspng.com/uploads/bluee-target-icon-6.png">
                <h2>CONNEXION</h2>
            </main>
            <main class="login">
                
                <label><b>LOGIN</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>PASSWORD</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='VALIDER' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p class='erreur'><b>*Utilisateur ou mot de passe incorrect*</b></p>";
                }

                if(isset($_GET['reconnect'])){
                    $con = $_GET['reconnect'];
                    if($con==1 || $con==2)
                        echo "<p class='new'><b>*Connectez-vous avec le nouveau profil*</b></p>";
                }
                
                ?>
            </main>
            <main class="inscri">
                <p>Pas encore membre ? <a href="inscription.php" class="btn">Inscrivez-vous gratuitement</a> en 30s.</p>
            </main>
             
        </form>
        <figure class="paint">
        	<img  height="500" width ="700" src="img/arena.png">
        </figure>
         
    </section>
    <?php
    }
    else 
    {
    ?>
    <section id="notcon">
      <p>Vous êtes déjà connecté !!</p>
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
