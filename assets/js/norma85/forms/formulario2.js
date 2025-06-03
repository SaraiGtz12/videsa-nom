$(document).ready(function(){
    $("#CamposRegistros").empty();

    for(let i=0;i<60; i++){
        let campo = ` 
            <tr> 
                <td>${i+1}</td> 
                <td><input type="number" class="form-control" name="Nox" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="CO"/></td> 
                <td><input type="number" class="form-control" name="O2" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="CO2" step="0.01"/></td> 
                <td><input type="number" class="form-control" name="Temp" step="0.1"/></td> 
            </tr>`; 

        $("#CamposRegistros").append(campo);
    }
    
});