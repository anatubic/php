<?php

class KomadOdece{

    private $id;
    private $naziv;
    private $opis; 
    private $velicina;
    private $cena;
    private $slika;

    public function __construct($id=null, $naziv=null, $opis=null,   $velicina=null,$cena=null,$slika=null)
    {
        $this->id=$id;
        $this->naziv=$naziv;
        $this->opis=$opis; 
        $this->velicina=$velicina;
        $this->cena=$cena;
        $this->slika=$slika;

    }




    
    public static function dodajOdecu($odeca, $conn){
        $upit = "insert into komadodece (naziv,opis,velicina,cena,slika) values ('$odeca->naziv','$odeca->opis','$odeca->velicina',$odeca->cena,'$odeca->slika')";
        
        return $conn->query($upit); 

    }

    public static function vratiSvuOdecu($conn){
        $upit = " select * from komadodece";
       
        return $conn->query($upit); 
    }

    public static function vratiKomadOdecePoID($id,$conn){
        $upit = " select * from komadodece where id=$id";
       
        return $conn->query($upit); 
    }

    public static function obrisiKomadOdece($id, $conn){
        $upit = " delete from  komadodece where id=$id";
       
        return $conn->query($upit); 
    }


    public static function azurirajOdecu($odeca,$conn){

        $upit = "update komadodece set cena=$odeca->cena,naziv='$odeca->naziv',opis='$odeca->opis',slika='$odeca->slika',velicina=$odeca->velicina where id=$odeca->id ";

        return $conn->query($upit); 

    }

   

}


?>