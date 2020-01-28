<?php
		$capacitetempo = 0;
        $dispook = 1;

        if ( $renametype == "Tente" ) {
        	$empres = 1; 
        }

        elseif ( $renametype == "Camping-car" ) {
        	$empres = 2;
        }

      
//foreach corresondance entre lieu et type
            $capacitetempo = 0;
            
			$requet="SELECT debut,fin,type FROM reservations WHERE lieu = \"$renamelieu\" AND debut BETWEEN\"$datedebut\" AND \"$datefin\" OR lieu = \"$renamelieu\" AND fin BETWEEN\"$datedebut\" AND \"$datefin\" ";
        
			$query4=mysqli_query($connexion,$requet);
			$result=mysqli_fetch_all($query4);
            

                    foreach ($result as $key) {
                      if ($key[2] =="Tente") {
                          $capacitetempo += 1;
                        }
                        elseif ($key[2] == "Camping-car") {
                          $capacitetempo += 2; 
                        }

                    }

                    $capacitetempo = $capacitetempo + $empres;



                    if ( $capacitetempo <= 4 ) {
                    	$dispook = 1;
                    }
                    else {
                    	$dispook = 0;
                    }
                         



?>