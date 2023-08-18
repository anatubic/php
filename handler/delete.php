<?php
    include '../databasebroker.php';
    include '../model/komadodece.php';

        if(isset($_POST['deleteid'])){
               $result=  KomadOdece::obrisiKomadOdece($_POST['deleteid'],$conn);

               if($result){
                   echo 'Success';
               }else{
                   echo 'Failed';
               }
            
                
         }


?>