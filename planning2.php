<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="camping.css">
    <title>Réservation Camping</title>
</head>
<body id="planning">
    <header id="head">
       <?php
       include("bar-nav.php");
       ?> 
    </header>

    <main id="corpplanning">
      <h1 id="titre">Calendrier</h1>

    <div id="jour">
      
              <form  method="post" action="planning2.php">
              <input id="arriere" type="submit" name="precedent" value="">
              </form>
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

              <form  method="post" action="planning2.php">
              <input id="avant" type="submit" name="suivant" value="">
              </form>
    </div>
    <div id="pub">
      <div class="photo">
      <p class="text">La Plage</p>
      <img class="publicite" src="img/plagecamping.jpg">
      <p class="paragraphe">Cette plage garde un trésor unique au monde : ses eaux d’un bleu perçant. Pour rajouter une touche d’exotisme à un panorama déjà splendide.</p>
      </div>

      <div class="photo" >
      <p class="text">Les Pins</p>
      <img class="publicite" src="img/pinscamping.jpg">
      <p class="paragraphe">Nos Pins sont un lieu unique et tranquille ou enfants et parents pourront s épanouir divers activités y sont organisées tout  au long de la journée</p>
      </div>
      <div  class="photo">
      <p class="text" >Le Maquis</p>
      <img class="publicite" src="img/maquiscamping.jpg">
      <p class="paragraphe">Notre maquis s’installe sur des terrains silencieux principalement où de nombreuses espèces buissonnantes forment une végétation souvent inextricable et fermée.</p>
      </div>
    </div> 

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

      
//foreach corresondance entre lieu et type
                    foreach ($resultat as $key) {
                      if ($key[2] == "Plage") {
                      if ($key[1] =="Tente") {
                          $capacite1+=1;
                        }
                        elseif ($key[1] == "Camping-car") {
                          $capacite1+=2; 
                        }

                        }
                         //echo $capacite1;

                        if ($key[2] == "Pins") {
                          if ($key[1] =="Tente") {
                            $capacite2+=1;
                          }
                          elseif ($key[1] == "Camping-car") {
                            $capacite2+=2;  
                          }
                      }
                        //echo $capacite2;

                      if ($key[2] == "Maquis") {
                        if ($key[1] =="Tente") {
                          $capacite3+=1;
                        }
                        elseif ($key[1] == "Camping-car") {
                          $capacite3+=2;  
                        }
                    }
                          //echo $capacite3;
                  }


$capacite = [$capacite1,$capacite2,$capacite3];
//tableau qui recupere les reservations et affiche les emplacements dispo
?>
<div id="tableau">
  <h3>Lieux et emplacements disponibles</h3>
   <table id="table">
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
                  echo "<div id=\"liens\"><a href=\"reservation.php\">Réservé</a></div>"; 
                  }
                  else{
                   echo "<div id=\"lien\"><a href=\"reservation-form.php\">Disponible</a></div>";
                   }
          
            echo "</td>";
           }
            echo "</tr>";
          }
    
?>
     </tbody>
   </table>
   </div>
 </main>
      
    
    <footer id="foot">
      <a href="https://fr-fr.facebook.com/"><img class="logo" src="img/facebook-logo.jpg"></a>
      <a href="https://www.instagram.com"><img class="logo" src="img/instagram-logo.jfif"></a>
      <a href="https://www.linkedin.com"><img class="logo" src="img/linkedin.jpg"></a>
      <a href="https://www.twitter.com"><img class="logo" src="img/twitter-logo.jpg"></a>

       <?php
       include("bar-nav.php");
       ?> 
    </footer>
</body>
</html>


