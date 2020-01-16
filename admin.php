<?php
session_start();
$connexion= mysqli_connect("localhost","root","","gestioncamping");
$requete= "SELECT * FROM reservations";
$query= mysqli_query($connexion,$requete);
$resultat = mysqli_fetch_all($query);
echo($resultat[0][8]);

var_dump($resultat);

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

    <!-- changement de prix -->
<h1>changement de prix </h1>
    <form action="" method="post">
      <select name="suplement" id="pet-select">
        <option value="">--Please choose an option--</option>
        <option value="borne">borne</option>
        <option value="disco">disco</option>
        <option value="pack">pack</option>
      </select>
      <label>Prix</label><br>
      <input type="number" name="prix1" placeholder="prix"><br>
      <input type="submit" name="accepte" value="valider"><br>


    </form>

        <?php  

    if (isset($_POST['accepte']))
    {

    $prix = $_POST['prix1'];
    $nom =  $_POST['suplement'];



      $requete2= "UPDATE tarif  SET prix= '$prix' where nom= '$nom'  ";
      $query2= mysqli_query($connexion,$requete2);

    }

        ?>

    <!-- modifier les reservation -->
    <form method="post"> 
      <label>Speudo:</label><br>
      <input type="text" name="pseudo" placeholder="speudo"><br>
      <select name="categorie">
        <option value="type">type</option>
        <option value="lieu">lieu</option>
        <option value="option">option</option>
        <option value="total">total</option>
      </select>
      <input type="text" name="resultat" placeholder="changement">
      <input type="submit" name="modifer" value="modifer">

    </form>
          <?php 


    if (isset($_POST['modifer']))
    {
          $name = $_POST['pseudo'];
    $categorie = $_POST['categorie'];
    $mod1 = $_POST['resultat'];
      $requete3= "UPDATE reservations  SET $categorie = '$mod1' where pseudo= '$name'  ";
      $query3= mysqli_query($connexion,$requete3);
          

    }

    // suprimer la resarvation
   ?>     
<form method="post"> 
      <label>Speudo:</label><br>
      <input type="text" name="pseudo2" placeholder="speudo"><br>
      <input type="submit" name="suprimer" value="suprimer">
</form>

      <?php  
 if (isset($_POST['suprimer']))
    {
      $name2 = $_POST['pseudo2'];
      $requete4= "DELETE FROM reservations WHERE pseudo= '$name2'";
      $query4= mysqli_query($connexion,$requete4);
          

    }

      ?>
      <?php
  }
  ?>







</body>
