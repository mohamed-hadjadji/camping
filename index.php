<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="reservation.css">
    <title>Accueil</title>
</head>
<body class="bodya">
    <?php 
    include("bar-nav.php");
    ?>
    <section id="userco">
    <?php
    if (isset($_SESSION['login'])==false)
    {
    ?>
   
    <a href="connexion.php"> <button type="button" class="reserver">REJOINEZ NOUS ET RESERVEZ MAINTENANT</button></a>

     <?php
    }
     elseif(isset($_SESSION['login'])==true)

    {
       

            $user = $_SESSION['login'];
            echo "<h3><b>Bonjour <u>$user,</u> vous êtes connecté vous pouvez réserver maintenant.</b></h3>"; 
    ?>
     <a href="planning2.php"> <button type="button" class="reserver">RESERVER MAINTENANT</button></a>

    <?php
    }
    ?>
  </section>
  <section id="defilie">
    <article id="tache1">
      <figure>
        <img src="img/tache1.png">
      </figure>
      <main id="picture1">
        <div class="pic1"><p>Paintball Enfant</p></div>
        <div class="pic2"><p>Paintball Adulte</p></div>
        <div class="pic3"><p>Paintball Anniversaire</p></div>
      </main>
    </article>
    <article id="tache2">
      <main id="picture2">
        <div class="pic4"><p>Paintball en Famille</p></div>
        <div class="pic5"><p>Autre Evenement</p></div>
        <div class="pic6"><p>Paintball EVG</p></div>
      </main>
      <figure>
        <img height="400" src="img/tache2.png">
      </figure>
    </article>
  </section>
  <section id="intro">

    <article id="present">
      <img height="80" src="img/target.png">
     
    </article>
    <article id="video">
     
      <iframe width="1300" height="600" src="https://www.youtube.com/embed/mGI5ZxCVVXA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </article>
  </section>
  <footer>
    
  </footer>
  
</body>
</html>