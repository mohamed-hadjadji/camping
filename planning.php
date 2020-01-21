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
$requete = "SELECT `type`, `lieu`, `debut`, `fin`, `options`, `id_utilisateur`, `total`, `pseudo` FROM `reservations` WHERE  pseudo='".$_SESSION['login']."'";
//$requete = "SELECT type, lieu, debut, fin,options, total FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);
var_dump($resultat);
?>
     <section id="choix">
            <h1><b>Veuillez choisir votre créneau et réservez</b></h1>
     </section>
     <section id="connexion">
        
        <table>
                <thead>
                    <tr>
                        <th></th>
                        <th><b>PLAGE</b></th>
                        <th><b>PINS</b></th>
                        <th><b>MAQUIS</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
function isdateok($heurecasebegin, $heurecaseend, $lecturebdd, $jour) {
    $k = 0;
    while ( $k < sizeof($lecturebdd) ) {
        $datecasebegin = date( 'H:i:s', strtotime($heurecasebegin) );
        $datecaseend = date( 'H:i:s', strtotime($heurecaseend) );
        $DateBegin = date( 'H:i:s', strtotime($lecturebdd[$k][3]) );
        $DateEnd = date( 'H:i:s', strtotime($lecturebdd[$k][5]) );
        if ( ($datecasebegin == $DateBegin) && $lecturebdd[$k][4] == $jour || ($datecaseend == $DateEnd) && $lecturebdd[$k][4] == $jour ) {
            return true;
        }
        $k++;
    }
}
$i = 0;
$j = 0;
while ( $i < 4 ) {
    if ( $i == 0 ) {
        $heured = "08:00:00";
        $heuref = "09:00:00";
    }
    if ( $i == 1 ) {
        $heured = "09:00:00";
        $heuref = "10:00:00";
    }
    if ( $i == 2 ) {
        $heured = "10:00:00";
        $heuref = "11:00:00";
    }
    if ( $i == 3 ) {
        $heured = "11:00:00";
        $heuref = "12:00:00";
    }
  
?>
    <tr>
        <?php
        while ($j < 4) {
            if ( $j == 1 ) {
                $jour = "Monday";
            }
            if ( $j == 2 ) {
                $jour = "Tuesday";
            }
            if ( $j == 3 ) {
                $jour = "Wednesday";
            }
         
            if ( $j == 0 ) {
        ?>
            <td class="cheures">
            <?php
                if ($i == 0) {
                    echo "Emplacement 1";
                }
                elseif ($i == 1) {
                    echo "Emplacement 2";
                }
                elseif ($i == 2) {
                    echo "Emplacement 3";
                }
                elseif ($i == 3) {
                    echo "Emplacement 4";
                } 
            }
            ?>
            </td>
            <?php
            if ( $j > 0 ) {
            ?>
            <?php
                $m = 0;
                while ( $m < 4 ) {
                    if ( $j == $m ) {
                        $l = 0;
                        while ( $l < 3 ) {
                            if ( $i == $l ) {
                                $isokevent = isdateok($heured, $heuref, $resultat, $jour);
                                if ( $isokevent == true ) {
                                    $requeteevent= "SELECT type, lieu, debut, fin, total FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE debut,\"%T\")=\"$heured\" AND debut, \"%W\")=\"$jour\" OR fin, \"%T\")=\"$heuref\" AND debut,\"%W\")=\"$jour\"";
                                    $getidresa="SELECT id FROM reservations WHERE debut=\"$heured\" AND debut,\"%W\")=\"$jour\" OR fin,\"%T\")=\"$heuref\" AND debut,\"%W\")=\"$jour\"";
                                    $queryevent = mysqli_query($connexion, $requeteevent);
                                    $queryresa = mysqli_query($connexion, $getidresa);
                                    $resultatevent = mysqli_fetch_all($queryevent);
                                    $resultatresa = mysqli_fetch_all($queryresa);
                                    $idresa = $resultatresa[0][0];
                                    echo "<td>Titre: ".$resultatevent[0][1]."<br />Organisateur: ".$resultatevent[0][0]."<br /><a href=\"reservation.php?idresa=".$idresa."\">Plus d'infos</a></td>";
                                }
                                else {
                                    echo "<td>"."<a href=\"reservation-form.php\"><div>Choisir</div></a>"."</td>";
                                }
                            unset($isokevent);
                            }
                            $l++;
                        }
                    }
                    $m++;
                }
                ?>
            <?php
            }
            $j++;
        }
        $j = 0;
        $i++;
} ?>
</tr>
            </tbody>
        </table>
      
    </section>
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


