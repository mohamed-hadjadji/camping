<?php
session_start();
// premier select
$connexion= mysqli_connect("localhost","root","","gestioncamping");
$requete= "SELECT * FROM reservations";
$query= mysqli_query($connexion,$requete);
$resultat = mysqli_fetch_all($query);

// 2eme select

$requetet= "SELECT * FROM tarif2";
$queryt= mysqli_query($connexion,$requetet);
$resultatt = mysqli_fetch_all($queryt);
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
    <th>ID</th><th>type</th><th>lieu</th><th>sejour</th><th>debut</th><th>fin</th><th>option1</th><th>option2</th><th>option3</th><th>total</th><th>id_user</th><th>pseudo</th>

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


    

    echo "<div id=\"personnesinscrites\">
    <table border>
    <tr>
    <th>ID</th><th>tente</th><th>campingcar</th><th>borne</th><th>disco</th><th>pack</th><th>id_reservation</th>

    </tr>
    </div>";

    foreach($resultatt as $key2)
    {
      echo "<tr>";
      foreach($key2 as $value2)
      {
        echo "<td>".$value2."</td>";
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
        <option value="tente">tente</option>
        <option value="campingcar">campingcar</option>
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



      $requete2= "UPDATE tarif2  SET $nom = '$prix' where '$nom'= '$nom'  ";
      $query2= mysqli_query($connexion,$requete2);
       echo "votre changement a eté pris en compte";

    }

        ?>

    <!-- modifier les reservation -->
    <h1>modifier les reservation</h1>
    <form method="post"> 
      <label>Speudo:</label><br>
      <input type="text" name="pseudo" placeholder="speudo"><br>
      <select name="categorie">
        <option value="type">type</option>
        <option value="lieu">lieu</option>
        <option value="total">total</option>
      </select>
       <input type="text" name="resultat" placeholder="changement">


      <!-- form 1 -->
       
     <fieldset>
  <legend>Veuillez sélectionner les supléments :</legend>
    <input type="checkbox" name="option1" value="borne">
    <label for="coding">borne</label>
    <input type="checkbox" name="option2" value="disco">
    <label for="music">disco</label>
    <input type="checkbox" name="option3" value="pack">
    <label for="music">pack</label>
</fieldset>

                <input type="submit" name="modifier" value="modifer">
      
 

    </form>
          <?php 


    if (isset($_POST['modifier']))
    {
      if(!isset($_POST['option1'])){
        $option1 = null;
      }
      else{
        $option1 = $_POST['option1'];
      }
      if(!isset($_POST['option2'])){
        $option2 = null;
      }
      else{
        $option2 = $_POST['option2'];
      }
      if(!isset($_POST['option3'])){
        $option3 = null;
      }
      else{
        $option3 = $_POST['option3'];
      }
      


          $name = $_POST['pseudo'];
    $categorie = $_POST['categorie'];
    
    $mod1 = $_POST['resultat'];

      $requete3= "UPDATE reservations  SET $categorie = '$mod1' , option1 = '$option1' , option2 = '$option2' , option3 = '$option3' where pseudo= '$name'  ";
      $query3= mysqli_query($connexion,$requete3);
      echo "votre modification a bien eté pris en compte";
          

    }
  


    // suprimer la reservation
   ?>    
   <h1>supprimer la reservation</h1> 
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
          echo "supression reusis";

    }

      ?>
      <?php
  }
  ?>







</body>
