<?php
 
    include 'model/velicina.php';
    include 'model/komadodece.php';
    include 'databasebroker.php';
 


    $velicine = Velicina::vratiSveVelicine($conn);

    $svaOdeca = KomadOdece::vratiSvuOdecu($conn);
 

  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nase porudzbine</title>
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Satisfy&display=swap" rel="stylesheet">
    <style>
    .navbar {
      background-color: pink !important;
    }
    .navbar-brand {
      font-family: 'Satisfy', cursive;
      color: white !important;
      font-size: 35px;
    }
    .header-image-container {
      position: relative;
    }
    .overlay-text {
      position: absolute;
      top: 30%;
      left: 36%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 24px;
      text-align: left;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }
    .hd {
      font-family: 'Satisfy', cursive;
    }
    body {
      background-image: url('./images/background.jpeg');
      background-size: cover;
      background-repeat: no-repeat;
    }
    .table {
      background-color: pink;
    }
  </style>
</head>
<body   >
   
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Butik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
        
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="pretraga" onkeyup="pretragaPoImenu()">
            <button type="button" class="btn btn-primary" style="float:right">
                        <i class="fas fa-search"></i>
                      </button>
            </form>
        </div>
        </nav>

    <div class="container mt-4 header-image-container">
    <div class="row">
      <div class="col-12">
        <img src="images/hdr.jpeg" alt="Header Picture" class="img-fluid">
        <div class="overlay-text">
          <h1 class="hd">Dobrodosli u Butik!</h1>
          <p>Izvrsite pregled porudzbina, azurirajte ih, obrisite ili dodajte nove. Pored toga, mozete ih i sortirati ili pretrazivati.</p>
        </div>
      </div>
    </div>
  </div>   
 


    <div class="container" style="margin-top:50px">
 
             <button type="button" class="btn btn-warning" onclick="sortiraj()">Sortiraj<i class="fa fa-sort" aria-hidden="true" ></i></button>
                      <select name="kriterijum" id="kriterijum" class="criteria">
                          <option value="price">Cena</option> 
                          <option value="name">Naziv</option>
                    </select>
           
            
            
            <table class="table" id="tabelaOdeca" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Velicina</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Slika</th>
                    <th scope="col"> Opcije </th>


                    </tr>
                </thead>
                <tbody>
                  <?php  
                  
                    while($red = $svaOdeca->fetch_array()): 
                      $velicina =   Velicina::vratiNazivVelicine($red['velicina'],$conn);  ?>
                    <tr>
                    <th  >   <?php   echo $red['id'];        ?>     </th>
                    <td><?php   echo $red['naziv'];        ?> </td>
                    <td style="max-width: 200px;"> <?php   echo $red['opis'];        ?> </td>
                    <td> <?php       echo   $velicina      ?> </td>
                    <td> <?php   echo $red['cena'];        ?> </td>
                    <td> <img src="images/<?php   echo $red['slika'];        ?>" alt="<?php   echo $red['slika'];        ?>"   style="width: 120px;height: auto;"> </td>
                    <td> 
                    <form  method="post">
                                                <button type="button" class="btn btn-success"    data-toggle="modal" data-target="#editModal"  onclick="azurirajOdecu(<?php echo   $red['id'];?>)" >  <i class="fas fa-pencil-alt"></i> </button> 
                                                <button type="button" class="btn btn-danger"    ><i class="fas fa-trash" onclick="obrisiOdecu(<?php echo   $red['id'];?>)"></i></button>  
                                                <button type="button" class="btn btn-warning"   data-toggle="modal" data-target="#profileModal"  onclick="prikaziOdecu(<?php echo   $red['id'];?>)" ><i class="far fa-id-card"></i></button>   </td>
                                                </form>
                                            </tr>

                    </td>
                    </tr>
                  <?php endwhile;?>
                </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal"   >Dodaj novi komad odece</button>  
        <br><br><br><br><br>   
    </div>




 
     





       <!--Modal: PROFILE-->
       <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header" >
        <img src="" alt="avatar" id="IMG" class="rounded"  style="margin-left: auto;margin-right: auto; ">
      </div>
      <!--Body-->
      <div class="modal-body text-center mb-1">

        <h5 class="mt-1 mb-2" id="nazivPreview"></h5>

        <div class="md-form ml-0 mr-0" style="text-align: center;">
           <p id="descriptionPreview">   </p>
           <i id="pricePreview" class="fa fa-tag"  aria-hidden="true"></i>
            <br>
      
        </div>

        <div class="text-center mt-4">
           


        </div>
      </div>


      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>




    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login with Avatar Form-->

 








<!-- add form modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Dodaj novi komad odece</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addform" name="addform" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="naziv" class="col-form-label">Naziv</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tshirt"></i> 
              </div>
              <input type="text" class="form-control" id="naziv" name="naziv" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="opis" class="col-form-label">Opis</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil"   aria-hidden="true"></i></span>
              </div>
              <input type="text" class="form-control" id="opis" name="opis" required="required">
            </div>
          </div>
          
          <div class="form-group">
            <label for="velicina" class="col-form-label">Velicina</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-ruler"></i></i></span>
              </div>
              <select name="velicina" id="velicina">
                                      <?php
                                        
                                        while($red =   $velicine->fetch_array()):
                                          $oznaka=$red["oznaka"];
                                    
                                      ?>
                                        <option value=<?php echo $red["id"]?>><?php echo $red["oznaka"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
            </div>
          </div>
          

          <div class="form-group">
            <label for="cena" class="col-form-label">Cena</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-tag"   aria-hidden="true"></i></span>
              </div>
              <input type="text" class="form-control" id="cena" name="cena" required="required">
            </div>
          </div>

          <div class="form-group">
            <label for="uploadfile" class="col-form-label">Slika</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-picture-o"   aria-hidden="true"></i></span>
              </div>
              <input type="file" class="form-control" id="uploadfile" name="uploadfile"   >
            </div>
          </div>


 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="addButton" >Submit</button> 
        </div>
      </form>
    </div>
  </div>
</div>
<!-- add form modal end -->








<!-- edit form modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Izmena</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editform" name="editform" method="POST" enctype="multipart/form-data">



        <div class="modal-body">
          <div class="form-group">
            <label for="naziv2" class="col-form-label">Naziv</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tshirt"></i> 
              </div>
              <input type="text" class="form-control" id="naziv2" name="naziv2" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="opis2" class="col-form-label">Opis</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil"   aria-hidden="true"></i></span>
              </div>
              <input type="text" class="form-control" id="opis2" name="opis2" required="required">
            </div>
          </div>
          
          <div class="form-group">
            <label for="velicina2" class="col-form-label">Velicina</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-ruler"></i></i></span>
              </div>
              <select name="velicina2" id="velicina2">
                                      <?php
                                            $velicine = Velicina::vratiSveVelicine($conn);
                                        while($red =   $velicine->fetch_array()):
                                          $oznaka=$red["oznaka"];
                                    
                                      ?>
                                        <option value=<?php echo $red["id"]?>><?php echo $red["oznaka"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
            </div>
          </div>
          

          <div class="form-group">
            <label for="cena" class="col-form-label">Cena</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-tag"   aria-hidden="true"></i></span>
              </div>
              <input type="text" class="form-control" id="cena2" name="cena2" required="required">
            </div>
          </div>

          <div class="form-group">
            <label for="uploadfile2" class="col-form-label">Slika</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-picture-o"   aria-hidden="true"></i></span>
              </div>
              <input type="file" class="form-control" id="uploadfile2" name="uploadfile2"   >
            </div>
          </div>


 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="editButton" >Submit</button> 
        </div>



                  <!-- Dodajemo ovde jedno skriveno polje da bismo sacuvali id odece koju azuriramo da bismo kasnije taj id mogli da koristimo u update.php -->
                  <input type="hidden" name="sakrivenoPolje" id="sakrivenoPolje" readonly>


                  <!-- Dodajemo jos jedno skriveno polje u kom cemo samo cuvati putanju do slike  -->
                  <input type="hidden" name="sakrivenoPolje2"   id="sakrivenoPolje2" readonly>
                                          <br><br><br>

      </form>
    </div>
  </div>
</div>
<!-- edit form modal end -->





       <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
     
   
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="js/main.js"></script>


      </body>
</html>