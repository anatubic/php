<?php
    include '../databasebroker.php';
    include '../model/komadodece.php';
   

    if (  isset($_POST['naziv2']) && isset($_POST['velicina2']) && isset($_POST['cena2'])) {
     

        //kada azuriamo neku odecu slika je opciona, pa cemo ovo raditi samo ako je korisnik postavio novu sliku
        if($_FILES["uploadfile2"]["name"]!=""){ //ovako znamo da korisnik nije nista uneo
            $filename = $_FILES["uploadfile2"]["name"];
           
            $tempname = $_FILES["uploadfile2"]["tmp_name"];    
            $folder = "../images/".$filename;
            move_uploaded_file($tempname, $folder);
        }else{
           
            //slika ostaje ono sto je i bila, ovaj podatak cemo citati iz skrivenog polja
            $filename = $_POST['sakrivenoPolje2'];
           
        }
        

                

                $odeca = new KomadOdece($_POST['sakrivenoPolje'],$_POST['naziv2'],$_POST['opis2'],$_POST['velicina2'],$_POST['cena2'], $filename);
        
            
                $status=KomadOdece::azurirajOdecu($odeca,$conn);
              
        
            
            if($status){
                
                echo 'Success';
            }else{
                echo 'Failed';
            }



      }
 




?>