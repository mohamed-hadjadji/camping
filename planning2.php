<?php session_start() ?>
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

$connexion = mysqli_connect("localhost", "root", "", "gestioncamping");
$requete = "SELECT type, lieu, DATE_FORMAT(debut, \"%T\"), debut, DATE_FORMAT(fin, \"%T\"), fin, DATE_FORMAT(debut, \"%W\"), option1, option2, option3, total FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_array($query);
var_dump($resultat);

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
        $capacitetente = 1;
        $capacitecamping = 2;
        $capacitelieu = 4;

       for ($emplacement=1; $emplacement <5 ; $emplacement++) { 
         echo "<tr>";
         echo "<td>Emplacement:".$emplacement."";
         for ($lieu=1; $lieu <4 ; $lieu++) { 
           echo "<td>";
           if (($capacitetente+$capacitecamping)>=$capacitelieu) {
             echo "il n y a plus de place";
           }
             else{
              echo "<a href=\"reservation-form.php\">Disponible</a>";
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


