<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="">
	<title>Réservation</title>
</head>
<body class="bodir">
	<?php
	include("bar-nav.php");
    

	if (isset($_SESSION['login']))
	{
        date_default_timezone_set('Europe/Paris');
        $connexion = mysqli_connect("localhost","root","","gestioncamping");
        $requete ="SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $requete1 = "SELECT * FROM tarif2 ";

        $req = mysqli_query($connexion, $requete1);

        while($row = mysqli_fetch_assoc($req))
       {
            $tentep= $row['tente'];
            $bornep= $row['borne'];
            $discop= $row['disco'];
            $packp= $row['pack'];
	
    
	?>
	<section  id="reservation-form-section">
     	<h1 id="h1reservation-form"><b>Veuillez remplir le formulaire de la réservation</b></h1>
     	<form class="reserv-form" method ="post" action ="">
     		<label class="labelreservationform" for="text"><b>Type: </b></label>
     	    <Select id="selectreservation-form" name="type">
                <option></option>
                <option>Tente</option>
                <option>Camping-car</option>               
            </select>
            <label class="labelreservationform" for="text"><b>lieu:</b></label>
          <Select id="selectreservation-form" name="lieu">
                <option>Plage</option>
                <option>Pins</option>
                <option>Maquis</option>                
          </select>
          <label class="labelreservationform" for="text"><b>Durée Séjour: </b></label>
            <input class="input-reservation-form" type="text" placeholder="Taper le nombre du jour" name="sejour" required>
            <label  for="datedebut"><b>Date de début: </b></label>
            <input  type="date" name="datedebut" required>
            <label  for="datefin"><b>Date de fin: </b></label>
            <input  type="date" name="datefin" required><br>
             
            <label  for="text"><b>Option</b></label></br>
            <input  type="checkbox" name="borne" value="borne">
            <label>Bornes éléctrique (<?php echo $row['borne']?>€ /jour)</label></br>
             <input type="checkbox" name="disco" value="disco">
            <label>Discothèque (<?php echo $row['disco']?>€ /jour)</label></br>
             <input type="checkbox" name="pack" value="pack">
            <label>Activités (<?php echo $row['pack']?>€ /jour)</label></br>
          
            <br><input type="submit" value="RESERVER" name="valider"></br>
     	</form>
     	<?php
        }
                    if ( isset($_POST["valider"]) )
                    {
                    	if(!isset($_POST['borne'])){
                         $option1 = null;
                        }
                        else{
                         $option1 = $_POST['borne'];
                        }
                        if(!isset($_POST['disco'])){
                        $option2 = null;
                        }
                        else{
                        $option2 = $_POST['disco'];
                        }
                        if(!isset($_POST['pack'])){
                         $option3 = null;
                        }
                        else{
                         $option3 = $_POST['pack'];
                        }

                        $typio = $_POST['type'];
                        $renametype = addslashes($typio); 
                        $lieu = $_POST['lieu'];
                        $renamelieu = addslashes($lieu);
                        $sejourio = $_POST['sejour'];
                        $renamesejour = addslashes($sejourio);
                        $datedebut = $_POST['datedebut'];
                        $datefin = $_POST['datefin'];
                   
                        $startdate = date('Y-m-d', strtotime($datedebut));
                        $enddate = date('Y-m-d', strtotime($datefin));

                        include("calcule.php");
                          
                          
                        if($startdate < date('Y-m-d')){
                              echo "Vous ne pouvez pas reserver a une date anterieur au ".date('d-m-Y');
                          
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

                                   $requete3 = "INSERT INTO reservations (type, lieu, sejour, debut, fin, option1, option2, option3, total, id_utilisateur) VALUES ('$renametype', '$renamelieu','$renamesejour', '$startdate', '$enddate', '$option1','$option2','$option3',$total,  ".$resultat[0]['id'].")";
                                      $query3 = mysqli_query($connexion, $requete3);
                                  }
                               }
                    }
               mysqli_close($connexion);
   }
   else 
   {
   ?>
    <section id="notcon">
      <p>Veuillez vous connecter pour accéder à votre page !</p>
    </section>
  <?php
  }
?>
                         

	



</body>
</html>