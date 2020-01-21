<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="reservation.css">
    <title>Réservation</title>
</head>
<body id="reservation-formbody">

    <?php

    include("bar-nav.php");
    if (isset($_SESSION['login']))
    {
       date_default_timezone_set('Europe/Paris'); 
       $connexion = mysqli_connect("localhost", "root", "","gestioncamping");
       $requete = "SELECT * FROM utilisateurs WHERE '".$_SESSION['login']."'";
       $query = mysqli_query($connexion, $requete);
       $resultat = mysqli_fetch_all($query,MYSQLI_ASSOC);
     ?>
     <section  id="reservation-form-section">
     	<h1 id="h1reservation-form"><b>Veuillez remplir le formulaire de la réservation</b></h1>
     	<form class="reserv-form" method ="post" action ="">
     		<label class="labelreservationform" for="text"><b>Type: </b></label>
     	    <Select id="selectreservation-form" name="type">
                <option>Tente</option>
                <option>Camping</option>               
          </select>
            <label class="labelreservationform" for="text"><b>lieu:</b></label>
          <Select id="selectreservation-form" name="lieu">
                <option>Plage</option>
                <option>Pins</option>
                <option>Maquis</option>                
          </select>
            <label  for="datedebut"><b>Date de début: </b></label>
            <input  type="date" name="datedebut" required>
            <label  for="datefin"><b>Date de fin: </b></label>
            <input  type="date" name="datefin" required><br>
            <label  for="total"><b>total </b></label>
            <input type="text" name="total"></input>
            <label  for="text"><b>Option</b></label></br>
            <input  type="checkbox" name="option">
            <label>bornes electrique</label></br>
             <input type="checkbox" name="option">
            <label>Discothèque</label></br>
             <input type="checkbox" name="option">
            <label>Activités</label></br>
          
          
            <br><input type="submit" value="RESERVER" name="valider">
     	</form>
     	<?php
                    if ( isset($_POST["valider"]) )
                    {
                          $titro = $_POST['type'];
                          $renametitre = addslashes($titro); 
                          $descriptio = $_POST['lieu'];
                          $renamedescritpion = addslashes($descriptio); 
                          $datedebut = $_POST['datedebut'];
                          $datefin = $_POST['datefin'];
                          $options = $_POST['option'];
                          $total = $_POST['total'];
                          $startdate = date('Y-m-d H:i:s', strtotime($datedebut));
                          $enddate = date('Y-m-d H:i:s', strtotime($datefin));
                         
                          if($startdate < date('Y-m-d H:i:s')){
                              echo "Vous ne pouvez pas reserver a une date anterieur au ".date('d-m-Y H:i:s');
                          
                          }
                          elseif ($enddate < $startdate) {
                              echo "Vous ne pouvez pas choisir une date de fin antérieur a la date de debut";
                          }
                          else{
                              $requete2 = "SELECT * FROM reservations WHERE (debut BETWEEN '$startdate' AND '$enddate') OR (fin BETWEEN '$startdate' AND '$enddate') ";
                              $query2 = mysqli_query($connexion, $requete2);
                              $resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
                              if(!empty($resultat2)){
                                echo "Une reservation existe deja a cette date";
                              }
                              else{
                              $requete3 = "INSERT INTO `reservations`( `type`, `lieu`, `debut`, `fin`, `options`, `id_utilisateur`, `total`, `pseudo`) VALUES '$renametitre','$renamedescritpion','$startdatetar','$enddate','$options','$total',".$resultat[0]['id'].")";
                              //$requete3 = "INSERT INTO reservations (type, lieu, debut, fin, options, total, id_utilisateur) VALUES ('$renametitre', '$renamedescritpion', '$startdate', '$enddate', '$options',".$resultat[0]['id'].")";
                              $query3 = mysqli_query($connexion, $requete3);
                              header('Location:planning2.php');
                              }   
                          } 
                    }
                  }
           

          
            ?>
     </section>
  
   
   
   ?>
    <section id="notcon">
      <p>Veuillez vous connecter pour accéder à votre page !</p>
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
