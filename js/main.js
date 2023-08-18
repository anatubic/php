$('#addform').submit(function () {

    var form = $('#addform')[0];
    var formData = new FormData(form);
    event.preventDefault();  
 

    request = $.ajax({  
        url: 'handler/insert.php',  
        type: 'post', 
        processData: false,
        contentType: false,
        data: formData
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log(textStatus);
        console.log(jqXHR);
      console.log(response);

        if (response === "Success") {
            alert("Odeca dodata");
            
            location.reload(true);
        }
        else {
       
            console.log("Odeca nije dodata" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska: ' + textStatus, errorThrown);
    });
}); 

function obrisiOdecu(deleteid){
 
    request = $.ajax({  
        url: 'handler/delete.php',  
        type: 'post', 
        data: {deleteid:deleteid},


        success: function(data, status){
            location.reload(true);
            alert("Uspesno obrisano!");
        }


    });



}

function prikaziOdecu(prikazid){
 

    $.post("handler/get.php",{prikazid:prikazid},function(data,status){
 
        var odecaid=JSON.parse(data); 
          
        $('#nazivPreview').text("   " + odecaid.naziv  );
        $('#descriptionPreview').text("   " +  odecaid.opis);
        $('#pricePreview').text("   " +  odecaid.cena);
 
        document.getElementById("IMG").src = 'images/'+odecaid.slika;


    });

}


function azurirajOdecu(azurirajid){  
    
 
    $.post("handler/get.php",{azurirajid:azurirajid},function(data,status){
         
          var odecaid=JSON.parse(data);//
                
        console.log(odecaid.slika);
        console.log(odecaid.id);

          $('#sakrivenoPolje2').val(odecaid.slika  );
          $('#sakrivenoPolje').val(odecaid.id  );
          $('#naziv2').val(odecaid.naziv  );
          $('#opis2').val(odecaid.opis);
          $('#cena2').val(odecaid.cena);
   
         
  
  
      }); 


}
 
$('#editform').submit(function () {
    var form = $('#editform')[0];
    var formData = new FormData(form);
    event.preventDefault();  
   
 


    request = $.ajax({  
        url: 'handler/update.php',  
        type: 'post', 
        processData: false,
        contentType: false,
        data: formData
    });

    request.done(function (response, textStatus, jqXHR) {
      
        if (response === "Success") {
            alert("Odeca azurirana");
            
            location.reload(true);
        }
        else {
       
            console.log("Odeca nije azurirana" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska: ' + textStatus, errorThrown);
    });
     
    


});

function pretragaPoImenu() {
    const input = document.querySelector('#pretraga');
    const filter = input.value.toUpperCase();
    const table = document.querySelector('#tabelaOdeca');
    const rows = Array.from(table.querySelectorAll('tr'));
  
    rows.forEach((row) => {
      const columns = Array.from(row.querySelectorAll('td'));
      const matches = columns.some((column) => {
        const text = column.textContent.toUpperCase();
        return text.includes(filter);
      });
  
      if (matches) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
}

function sortiraj() {
 
    var table, rows, switching, i, j, z, k, x, y, shouldSwitch;
    table = document.getElementById("tabelaOdeca");


    var e = document.getElementById("kriterijum");
    console.log(e);
    var result = e.options[e.selectedIndex].value;
   console.log(result);

 



    //SORT po ceni
    // sortira tako da najjeftiniji postovi idu na vrh
    if (result == "price") {
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            for (j = i + 1; j < rows.length; j++) {
                x = rows[i].getElementsByTagName("TD")[3];
                y = rows[j].getElementsByTagName("TD")[3];
                z = parseInt(x.innerHTML);
                k = parseInt(y.innerHTML);
                if (z > k) {
                    rows[i].parentNode.insertBefore(rows[j], rows[i]);
                }
            }
        }

    }


    //SORT po imenu  
 
    if (result == "name") {
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            for (j = i + 1; j < rows.length; j++) {
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[j].getElementsByTagName("TD")[0];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    rows[i].parentNode.insertBefore(rows[j], rows[i]);
                }
            }
        }
    }


}

 




