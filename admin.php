<?php
 session_start();
$connexion= mysqli_connect("localhost","root","","gestioncamping");
$requete= "SELECT * FROM reservations";
$query= mysqli_query($connexion,$requete);
$resultat = mysqli_fetch_all($query);

// etape 2

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <meta sharset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
        <link rel="stylesheet" href= "admin.css">
        <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">

    </head>



<body>

<?php

if ($_SESSION['login'] !="admin")
{
  echo "Vous n'avez pas acces a la page";
}
else{

  echo "<div id=\"personnesinscrites\">
  <table border>
        <tr>
          <th>ID</th><th>Type</th><th>lieu</th><th>debut</th><th>Fin</th><th>options</th><th>id-utili</th><th>total</th>

        </tr>
</div>";

    foreach($resultat as $key)
    {
      echo "<tr>";
      foreach($key as $value)
      {
        echo "<td>".$value."</td>";
      }
      echo "</tr>";
    }
   echo "</table>";




?>
<form action="" method="post">
<select name="suplement" id="pet-select">
    <option value="">--Please choose an option--</option>
    <option value="borne">borne</option>
    <option value="disco">disco</option>
    <option value="pack">pack</option>
</select>
  <label>Prix</label><br>
  <input type="number" name="prix1"><br>
  <input type="submit" name="accepte" value="valider"><br>


</form>

<?php  
$prix = $_POST['prix1'];
$nom =  $_POST['suplement'];
if (isset($_POST['accepte']))
{


//   $requete3= "SELECT nom FROM tarif";
// $query3= mysqli_query($connexion,$requete3);
// $resultat3 = mysqli_fetch_all($query3);


  $requete2= "UPDATE tarif  SET prix= '$prix' where nom= '$nom'  ";
$query2= mysqli_query($connexion,$requete2);

}

}
?>






</body>
