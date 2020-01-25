<?php

if ($_POST['type']=="Tente")
{
  $requete1 = "SELECT * FROM tarif2 ";

  $req = mysqli_query($connexion, $requete1);

  while($row = mysqli_fetch_assoc($req))
  {
     $tentep= $row['tente'];
     $bornep= $row['borne'];
     $discop= $row['disco'];
     $packp= $row['pack'];
  
      if(isset($_POST['borne'])&& isset($_POST['disco']) &&isset($_POST['pack']))
        {
           
            $add= $tentep+$bornep+$discop+$packp;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
        }

      if(isset($_POST['borne'])&& !isset($_POST['disco']) && !isset($_POST['pack']))
      {
        
            $add= $tentep+$bornep;
            $total= $add*$_POST['sejour'];
        
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
      if(isset($_POST['borne'])&& isset($_POST['disco']) && !isset($_POST['pack']))
      {

            $add= $tentep+$bornep+$discop;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(isset($_POST['borne'])&& !isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $tentep+$bornep+$packp;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(!isset($_POST['borne'])&& isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $tentep+$discop+$packp;
            $total= $add*$_POST['sejour'];
            
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
      if(!isset($_POST['borne'])&& isset($_POST['disco']) && !isset($_POST['pack']))
      {
        
            $add= $tentep+$discop;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(!isset($_POST['borne'])&& !isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $tentep+$packp;
            $total= $add*$_POST['sejour'];
            
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }                
      elseif(empty($_POST['borne'])&& empty($_POST['disco']) && empty($_POST['pack']))
      {
         $total=$tentep*$_POST['sejour'];
        echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
  }
}
elseif($_POST['type']=="Camping-car")
{
  $requete1 = "SELECT * FROM tarif2 ";

  $req = mysqli_query($connexion, $requete1);

  while($row = mysqli_fetch_assoc($req))
  {
     $campingp= $row['campingcar'];
     $bornep= $row['borne'];
     $discop= $row['disco'];
     $packp= $row['pack'];
  
      if(isset($_POST['borne'])&& isset($_POST['disco']) &&isset($_POST['pack']))
        {
           
            $add= $campingp+$bornep+$discop+$packp;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
        }

      if(isset($_POST['borne'])&& !isset($_POST['disco']) && !isset($_POST['pack']))
      {
        
            $add= $campingp+$bornep;
            $total= $add*$_POST['sejour'];
        
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
      if(isset($_POST['borne'])&& isset($_POST['disco']) && !isset($_POST['pack']))
      {

            $add= $campingp+$bornep+$discop;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(isset($_POST['borne'])&& !isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $campingp+$bornep+$packp;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(!isset($_POST['borne'])&& isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $campingp+$discop+$packp;
            $total= $add*$_POST['sejour'];
            
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
      if(!isset($_POST['borne'])&& isset($_POST['disco']) && !isset($_POST['pack']))
      {
        
            $add= $campingp+$discop;
            $total= $add*$_POST['sejour'];

          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }

      if(!isset($_POST['borne'])&& !isset($_POST['disco']) && isset($_POST['pack']))
      {
        
            $add= $campingp+$packp;
            $total= $add*$_POST['sejour'];
            
          echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }                
      elseif(empty($_POST['borne'])&& empty($_POST['disco']) && empty($_POST['pack']))
      {
         $total=$campingp*$_POST['sejour'];
        echo "<h1>Total:<b>".$total."€</b></h1><br/>";
      }
  }
}
      
        