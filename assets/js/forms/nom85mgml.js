$(document).ready(function(){
    var clickbtn = 60;
    var contador = 0;

    function agregarFila(){ 
        let campo = ` 
            <tr> 
                <td>${contador}</td> 
                <td><input type="number" class="form-control" name="Nox" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="CO"/></td> 
                <td><input type="number" class="form-control" name="O2" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="CO2" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="Temp" step="0.1"/></td> 
            </tr>`; 

        $("#CamposRegistros").append(campo);
    }

    for(let i=0;i<clickbtn; i++){
        contador ++;
        agregarFila();
    }

    $("#AgregarFila").click(function(){ 
        if(clickbtn < 60){ 
            clickbtn++; 
            contador ++;
            agregarFila();
        }
    }); 
});