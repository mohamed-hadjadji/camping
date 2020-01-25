<?php
    session_start();
    unset($_SESSION['num']);
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="camping.css">
    <title>Accueil</title>
</head>
<body class="bodya">
  <header class="headeri">
    <?php 
    include("bar-nav.php");
    ?>
    <main id="user">
    <?php
    if (isset($_SESSION['login'])==false)
    {
       echo "<h3>Connectez vous et réservez maintenanat";
    }
    elseif(isset($_SESSION['login'])==true)

    {
       if($_SESSION['login'] =="admin")
       {
        $user = $_SESSION['login'];
            echo "<h3><b>Bonjour <u>$user,</u> vous êtes connecté.</b></h3>";
       }
       else
       {
        $user = $_SESSION['login'];
            echo "<h3><b>Bonjour <u>$user,</u> vous êtes connecté vous pouvez réserver maintenant.</b></h3>"; 
       }
    }
    ?>
    </main>
    
    <main id="logo">
       <figure><img src="img/logo-sardines.png"></figure>
    </main>
    <ul class="slideshow">
      <li><span></span></li>
      <li><span></span></li>
      <li><span></span></li>
      <li><span></span></li>
      <li><span></span></li>
    </ul>  
  </header>
  <section class="userco">
    <article id="camp">
       <h2>Notre sélection camping</h2>
    </article>

    <article id="choix">
    <a href="planning.php"><div class="post1">
            <div id="pic1"></div>
            <div id="para">
                           <h3>La Plage</h3> 
                           <p><b>Tente:</b> à partir de 10€ /Jour</p> 
                           <p><b>Camping car:</b> à partir de 20€ /Jour</p>             
                        </div>    
          </div></a>
              <a href="planning.php"><div class="post1">
            <div id="pic2"></div>
            <div id="para">
                           <h3>Les Pins</h3> 
                           <p><b>Tente:</b> à partir de 10€ /Jour</p> 
                           <p><b>Camping car:</b> à partir de 20€ /Jour</p>            
                        </div>    
          </div></a> 
          <a href="planning.php"><div class="post1">
            <div id="pic3"></div>
            <div id="para">
                           <h3>Le Maquis</h3> 
                           <p><b>Tente:</b> à partir de 10€ /Jour</p> 
                           <p><b>Camping car:</b> à partir de 20€ /Jour</p>             
                        </div>    
          </div></a>       

    </article>
  </section>
 
  <?php
  include("footer.php");
  ?>
  
</body>
</html>