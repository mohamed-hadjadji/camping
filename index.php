<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="">
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
   

     <?php
    }
     elseif(isset($_SESSION['login'])==true)

    {
       

            $user = $_SESSION['login'];
            echo "<h3><b>Bonjour <u>$user,</u> vous êtes connecté vous pouvez réserver maintenant.</b></h3>"; 
    ?>
     

    <?php
    }
    ?>
  </section>
  <section id="defilie">
   
  </section>
  <section id="intro">

  </section>
  <footer>
    
  </footer>
  
</body>
</html>