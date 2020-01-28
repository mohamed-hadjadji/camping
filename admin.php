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




// etape 2

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <meta sharset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
  <link rel="stylesheet" href= "camping.css">
  <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">

</head>

<body id=body-admin>
  


  <?php
  if (isset($_SESSION['login'])){

  if ($_SESSION['login'] !="admin")
  {
    echo "Vous n'avez pas acces a la page";
  }
  else{

    ?>
    <header id="header-admin">
      <?php
      include('bar-nav.php');

      ?>
    </header>
    <main id="main-admin" >
      <div id= "tab-admin">
      <?php

    
    echo "<div id=\"reserv-admin\">";
    echo "<h1>Reservations</h1>";
    ?>
    <table id="table1-admin" border>
    <tr>
    <th>ID</th><th>type</th><th>lieu</th><th>sejour</th><th>debut</th><th>fin</th><th>option1</th><th>option2</th><th>option3</th><th>total</th><th>id_user</th><th>pseudo</th>

    </tr>

    
    <?php

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
    
    <?php  


    
    echo "<h1>tarif</h1>";
    echo "
    <table id=\"table2-admin\" border>
    <tr>
    <th>ID</th><th>tente</th><th>campingcar</th><th>borne</th><th>disco</th><th>pack</th><th>id_reservation</th>

    </tr>";
    

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
    </div>
    <div id="content-admin">
    

    <!-- changement de prix -->
    <div id="admin-chang">
<h1 class="h1-admin">changement de prix </h1>
    <form action="" method="post">
      <label class="label-admin">Categorie</label><br>
      <select name="suplement" id="pet-select">
        <option value="">--Choisissez votre options--</option>
        <option value="borne">borne</option>
        <option value="disco">disco</option>
        <option value="pack">pack</option>
        <option value="tente">tente</option>
        <option value="campingcar">campingcar</option>
      </select><br>
      <label class="label-admin">Prix</label><br>
      <input class="bouton-admin" type="number" name="prix1" placeholder="prix"><br>
      <input class="bouton-admin" type="submit" name="accepte" value="valider"><br>


    </form>

        <?php  

    if (isset($_POST['accepte']))
    {

    $prix = $_POST['prix1'];
    $nom =  $_POST['suplement'];



      $requete2= "UPDATE tarif2  SET $nom = '$prix' where '$nom'= '$nom'  ";
      $query2= mysqli_query($connexion,$requete2);
       echo "votre changement a eté pris en compte";

       header('Location: admin.php');
// Nécessite qu'aucun affichage html n'est déjà été envoyé au navigateur
// example.php est la page cible de la redirection
// Redirection immédiate

    }

        ?>
      </div>

    <!-- modifier les reservation -->
    <div id="modif-admin">
    <h1 class="h1-admin">modifier les reservation</h1>
    <form method="post"> 
      <input class="bouton-admin" type="text" name="pseudo" placeholder="pseudo"><br>
      <select name="categorie">
        <option value="type">type</option>
        <option value="lieu">lieu</option>
        <option value="total">total</option>
      </select>
       <input class="bouton-admin" type="text" name="resultat" placeholder="changement"><br>


      <!-- form 1 -->
       
     
  <legend class="legend-admin"><b>Veuillez sélectionner les supléments :</b></legend>
    <input class="bouton-admin2" type="checkbox" name="option1" value="borne">
    <label id="label-admin" for="borne">borne</label>
    <input class="bouton-admin2" type="checkbox" name="option2" value="disco">
    <label id="label-admin" for="disco">disco</label>
    <input class="bouton-admin2" type="checkbox" name="option3" value="pack">
    <label id="label-admin" for="pack">pack</label><br>


                <input class="bouton-admin" type="submit" name="modifier" value="modifier">
      
 

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
      header('Location: admin.php');
          

    }
  
?>
</div>
    <!-- suprimer la reservation -->
     <div id="sup-admin">
   <h1 class="h1-admin">supprimer la reservation</h1> 
<form method="post"> 
      <label class="label-admin">pseudo:</label><br>
      <input class="bouton-admin" type="text" name="pseudo2" placeholder="pseudo"><br>
      <input class="bouton-admin" type="submit" name="suprimer" value="suprimer">
</form>

      <?php  
 if (isset($_POST['suprimer']))
    {
      $name2 = $_POST['pseudo2'];
      $requete4= "DELETE FROM reservations WHERE pseudo= '$name2'";
      $query4= mysqli_query($connexion,$requete4);
          echo "supression reusis";
          header('Location: admin.php');

    }

      ?>

</div>
  </div>

</main>

<?php

}
include("footer.php");
}
else{
   ?>
    <header id="header-admin">
      <?php
      include('bar-nav.php');

      ?>
    </header>
    <?php
  echo "Vous n'avez pas acces a la page";
  include("footer.php");
  

}
?>

</body>
</html>
