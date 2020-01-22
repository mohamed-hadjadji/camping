<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="reservation.css">
    <title>Réservation</title>
</head>
<body class="bodyt">
    <header>
        <nav id="menu">
            <div class="nav1">
                
                <a href="index.php">INDEX</a>

            </div>
            <div class="nav2">
                <a href="index.php"><h2>Accueil</h2></a>
                <a href="profil.php"><h2>Modification</h2></a>
                <a href="planning.php"><h2>Planning</h2></a>
                <a href="reservation-form.php"><h2>Réservation</h2></a>
                <a href="index.php?deconnexion=true"><h2>Déconnexion</h2></a>
            </div>
        </nav>
    
    </header>
<?php
session_start();

$datejour = new DateTime("today");

//var_dump($datejour);

if (!isset($_SESSION["num"])) {
    $_SESSION["num"] = 0;
}

if (isset($_POST["suivant"])) {
    $_SESSION["num"] += 1;
}

if (isset($_POST["precedent"])) {
    $_SESSION["num"] -= 1;
}

//echo $_SESSION["num"];

date_add($datejour, date_interval_create_from_date_string($_SESSION['num']." days"));

echo date_format($datejour, 'Y-m-d');

$dateselec = date_format($datejour, 'Y-m-d');




?>

<form method="post" action="planning2.php">
    <input type="submit" name="suivant" value=">">
    <input type="submit" name="precedent" value="<">
</form>

    <?php 
//requete qui recupere tout de l utilisateur
$connexion = mysqli_connect("localhost", "root", "", "gestioncamping");
$requete = "SELECT login, type, lieu, DATE_FORMAT(debut, \"%Y-%m-%d\"), DATE_FORMAT(fin, \"%Y-%m-%d\"), option1, option2, option3, total FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE \"$dateselec\" BETWEEN DATE_FORMAT(debut, \"%Y-%m-%d\") AND DATE_FORMAT(fin, \"%Y-%m-%d\")";
$query = mysqli_query($connexion, $requete);
//var_dump($query);
$resultat = mysqli_fetch_all($query);
//var_dump($resultat);


        $capacite1 = 0;
        $capacite2 = 0;
        $capacite3 = 0;

      
//foreach lieu par rapport a type
                    foreach ($resultat as $key) {
                      if ($key[2] == "plage") {
                      if ($key[1] =="tente") {
                          $capacite1+=1;
                        }
                        elseif ($key[1] == "camping") {
                          $capacite1+=2; 
                        }

                        }
                         echo $capacite1;

                        if ($key[2] == "pins") {
                          if ($key[1] =="tente") {
                            $capacite2+=1;
                          }
                          elseif ($key[1] == "camping") {
                            $capacite2+=2;  
                          }
                      }
                        echo $capacite2;

                      if ($key[2] == "maquis") {
                        if ($key[1] =="tente") {
                          $capacite3+=1;
                        }
                        elseif ($key[1] == "camping") {
                          $capacite3+=2;  
                        }
                    }
                      echo $capacite3;
                  }


$capacite = [$capacite1,$capacite2,$capacite3];

?>
   <table>
       <thead>
           <tr>
               <th></th>
               <th>Plage</th>
               <th>Pins</th>
               <th>Maquis</th>
       </thead>
       <tbody>

<?php
          for ($emplacement=1; $emplacement <5 ; $emplacement++) { 
                echo "<tr>";
                echo "<td>Emplacement:".$emplacement."";

              for ($lieu=0; $lieu <3 ; $lieu++) { 
                echo "<td>";
              
                if ($capacite[$lieu]>= $emplacement){
                  echo "Réservé";
                  }
                  else{
                   echo "Dispo";
                   }
           
            echo "</td>";
           }
            echo "</tr>";
          }
    
            ?>
       </tbody>
   </table>
      
    
    <footer>

    </footer>
</body>
</html>


