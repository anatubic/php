<?php
class Velicina{
    private $id;
    private $oznaka;




    
    public static function vratiSveVelicine($conn){
        $upit = "SELECT * from velicina";


        return $conn->query($upit);

    }
 
    public static function vratiNazivVelicine($id, $conn){
        $upit = "SELECT * from velicina where id=$id";


        $rezultat= $conn->query($upit);
        $niz  = array();

        if($rezultat){
            while($red = $rezultat->fetch_array()){

                $myArray[] = $red;
            }
        }
        return $myArray[0]['oznaka'];
    }



    



}
   



?>