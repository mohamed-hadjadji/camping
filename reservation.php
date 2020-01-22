<?php
session_start();
ob_start();


    $connexion= mysqli_connect("localhost", "root", "", "gestioncamping");
    if ( isset($_SESSION['login']) ) 
    {
      $login= $_SESSION['login'];
     $requete = "SELECT type,lieu,sejour,debut,fin,option1,option2,option3,total,pseudo FROM reservations WHERE pseudo ='".$_SESSION['login']."'";
      // $requete = "SELECT * FROM reservations where pseudo= '".$_SESSION['login']."'";

    $query = mysqli_query($connexion, $requete);
    $resultat = mysqli_fetch_all($query);
    var_dump($resultat);
    $taille = count($resultat) - 1;
    

?>
<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="reservation.css">
    <title>Réservation</title>
</head>
<body class="bodyt">
    <header>
        <nav id="menu">

            <div class="nav2">
                <a href="index.php"><h2>Accueil</h2></a>
                <a href="profil.php"><h2>Modification</h2></a>
                <a href="planning.php"><h2>Planning</h2></a>
                <a href="reservation-form.php"><h2>Réservation</h2></a>
                <a href="index.php?deconnexion=true"><h2>Déconnexion</h2></a>
            </div>
        </nav>
    
    </header>

 <section>
      <?php  
       $i = 0;
          echo "<table border>";
          echo "<thead><tr>";
          echo "<th>type</th>";
          echo "<th>lieu</th>";
          echo "<th>sejour</th>";
          echo "<th>debut</th>";
          echo "<th>fin</th>";
          echo "<th>option1</th>";
          echo "<th>option2</th>";
          echo "<th>option3</th>";
          echo "<th>total</th>";
          echo "<th>pseudo</th>";

        echo "</tr></thead>";
          echo "<tbody>";
          while ($i <= $taille) 
          {
            echo "<tr>";
            foreach ($resultat[$i] as $key => $value) 
            {
               echo "<td>{$value}</td>"; //contenue
            }
            echo "</tr>";
            $i++;
          }
          echo "</tbody></table>";
      ?>
  
  </section>
  <?php 
  }
  else {
    echo "vous n'avez pas de reservations a votre nom";
  } 
?>

		
	
	