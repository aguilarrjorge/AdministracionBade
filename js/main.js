document.addEventListener("DOMContentLoaded", function() {   
    var input_contratante = document.getElementById("contratante")        
    var search = document.getElementById("btn_search");

    input_contratante.addEventListener("input", function(event) {
        console.log("El valor del input es:", event.target.value);

        if(input_contratante.value != '')
            search.disabled = false;
        else
            search.disabled = true;

    });

    stopVideo();
});

function generaPDF(){
    var contratante = document.getElementById("contratante").value
    var metlife = document.getElementById("metlife")
    var gnp = document.getElementById("gnp")
    var atlas = document.getElementById("atlas")
    var ana_seguros = document.getElementById("ana")
    var mafre = document.getElementById("mafre")
    var vepormas = document.getElementById("vepormas")
    var hir = document.getElementById("hir")
    var banorte = document.getElementById("banorte")
    var inbursa = document.getElementById("inbursa")
    var axa = document.getElementById("axa")
    var monterrey = document.getElementById("monterrey")
    var allianz = document.getElementById("allianz")
    var argos = document.getElementById("argos")

    var arrayAseguradoras = ''    

    if(metlife.checked == false && gnp.checked == false &&  atlas.checked == false &&  ana_seguros.checked == false && mafre.checked == false && vepormas.checked == false && hir.checked == false && banorte.checked == false && inbursa.checked == false && axa.checked == false && monterrey.checked == false && allianz.checked == false &&  argos.checked == false)
            document.getElementById("text-alert").style.display ='block'           

    else{ 

        if (metlife.checked == true) {
            arrayAseguradoras = metlife.name + ';' + arrayAseguradoras;
        }if (gnp.checked == true) {
            arrayAseguradoras = gnp.name + ';' + arrayAseguradoras;
        }if (atlas.checked == true) {
            arrayAseguradoras = atlas.name + ';' + arrayAseguradoras;
        }if (ana_seguros.checked == true) {
            arrayAseguradoras = ana_seguros.name + ';' + arrayAseguradoras;
        }
        if (mafre.checked == true) {
            arrayAseguradoras = mafre.name + ';' + arrayAseguradoras;
        }
        if (vepormas.checked == true) {
            arrayAseguradoras = vepormas.name + ';' + arrayAseguradoras;
        }
        if (hir.checked == true) {
            arrayAseguradoras = hir.name + ';' + arrayAseguradoras;
        }
        if (banorte.checked == true) {
            arrayAseguradoras = banorte.name + ';' + arrayAseguradoras;
        }
        if (inbursa.checked == true) {
            arrayAseguradoras = inbursa.name + ';' + arrayAseguradoras;
        }
        if (axa.checked == true) {
            arrayAseguradoras = axa.name + ';' + arrayAseguradoras;
        }
        if (monterrey.checked == true) {
            arrayAseguradoras = monterrey.name + ';' + arrayAseguradoras;
        }
        if (allianz.checked == true) {
            arrayAseguradoras = allianz.name + ';' + arrayAseguradoras;
        }
         if (argos.checked == true) {
            arrayAseguradoras = argos.name + ';' + arrayAseguradoras;
        }

        console.log("arrayAseguradoras = " + arrayAseguradoras)



        //const params = new URLSearchParams({ key: contratante, aseguradoras: arrayAseguradoras});
        /*//window.location.href = 'GenerarPDF.php?' + params.toString();
        window.location.href = 'php/selectCia.php?' + params.toString();*/


        $.ajax({
            url: "php/selectCia.php",
            type: "POST",
            data: {
                contratante:contratante,
                aseguradoras: arrayAseguradoras 
            },
            dataType: 'json', 
            success: function(response){
                $('#seccion_about').hide();
                $('#result').show();
                $('#home').hide();

                $('#videoModal').modal('hide');

                if (response) {
                      document.querySelector('#result').scrollIntoView({
                        behavior: 'smooth', // Desplazamiento suave
                        block: 'start'      // Posiciona al inicio de la ventana
                      });
                  }

                console.log("Response: " + response.contratante);
                console.log("Response: " + response.cia);
                console.log("Response: " + response.pdf);

                $(`#ans_cias`).html(`<img src="img/cia/${response.cia + ".png"}" width="80%;">`);
                $(`#ans_cias_download`).html(`<a class="border-bottom text-decoration-none" href="GenerarPDF.php?contratante=${response.contratante}&cia=${response.cia}&pdf=${response.pdf}" style="color: #0C4DA2 !important;" target="_blank">Descargar</a>`);

            },
            error: function(){
                console.log("ERROR");
            }
        });


    }
}

function checkedAll(){
    var myButton = document.getElementById("buttonAll")
    var metlife = document.getElementById("metlife")
    var gnp = document.getElementById("gnp")
    var atlas = document.getElementById("atlas")
    var ana_seguros = document.getElementById("ana")

    var mafre = document.getElementById("mafre")
    var vepormas = document.getElementById("vepormas")
    var hir = document.getElementById("hir")
    var banorte = document.getElementById("banorte")
    var inbursa = document.getElementById("inbursa")
    var axa = document.getElementById("axa")
    var monterrey = document.getElementById("monterrey")
    var allianz = document.getElementById("allianz")
    var argos = document.getElementById("argos")


    console.log("myButton" + myButton.textContent)

    if(myButton.textContent == 'Seleccionar Todos'){                
        document.getElementById("text-alert").style.display ='none'
        metlife.checked = true
        gnp.checked = true
        atlas.checked = true
        ana_seguros.checked = true

        mafre.checked = true
        vepormas.checked = true
        hir.checked = true
        banorte.checked = true
        inbursa.checked = true
        axa.checked = true
        monterrey.checked = true
        allianz.checked = true
        argos.checked = true

        myButton.textContent = 'Desmarcar Todos'
    }else if(myButton.textContent == 'Desmarcar Todos'){
         metlife.checked = false
        gnp.checked = false
        atlas.checked = false
        ana_seguros.checked = false
        mafre.checked = false
        vepormas.checked = false
        hir.checked = false
        banorte.checked = false
        inbursa.checked = false
        axa.checked = false
        monterrey.checked = false
        allianz.checked = false
        argos.checked = false


        myButton.textContent = 'Seleccionar Todos'
    }
}

function stopVideo() {
  var iframe = document.getElementById('videoPlayer');      
  var src = iframe.src;
  
  iframe.src = '';  
  iframe.src = src; 
}   

        
