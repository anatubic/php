<?php
    include '../databasebroker.php';
    include '../model/komadodece.php';
   

    if ( isset($_POST['naziv']) && isset($_POST['velicina']) && isset($_POST['cena'])) {
     
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "../images/".$filename;

        

        move_uploaded_file($tempname, $folder);

       $odeca = new KomadOdece(null,$_POST['naziv'],$_POST['opis'],$_POST['velicina'],$_POST['cena'], $filename);
  
       
        $status=KomadOdece::dodajOdecu($odeca,$conn);
        
        
            
            if($status){
                
                echo 'Success';
            }else{
                echo 'Failed';
            }



      }
 




?>