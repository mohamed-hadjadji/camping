<html>
<head>
    <meta charset="utf-8">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,700,900,300,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="camping.css">
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

        <div id="main" class="container">   
            <form name="loginform" id="loginform" action="#" method="post" class="wpl-track-me"> 
                <p class="login-username">
                    <label for="user_login">Username</label> 
                    <input type="text" id="user_login" class="input" placeholder="Username" value="" size="20" name="login" required/> 
                </p> 
                <p class="login-password"> 
                    <label for="user_pass">Password</label>
                    <input type="password" name="password" id="user_pass" class="input" placeholder="Password" value="" size="20" required/> 
                </p>    

                <p class="login-submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Log in" />
                    <input type="hidden" name="redirect_to" value="#"/>
                </p>    
         
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
     </div>
        
         
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

    include("footer.php");
    ?>
   
</body>
</html>
