<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="">
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
                <p>Pas encore membre ? <a href="inscription.php" class="btn">Inscrivez-vous gratuitement</a></p>
            </main>
             
        </form>
        
         
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
   
</body>
</html>
