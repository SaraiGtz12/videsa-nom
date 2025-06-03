$(document).ready(function(){

    let tabla = `
        <form action="">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>N°</th>
                            <th>Nox(ppmv)</th>
                            <th>CO (ppmv)</th>
                            <th>O2(%)</th>
                            <th>CO<sub>2</sub> %</th>
                            <th>Temp, En el Conducto C°</th>
                        </tr>
                    </thead>
                    <tbody id="CamposRegistros">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                            <td colspan="1">
                                <div class="d-grid">
                                    <input type="submit" value="Agregar" class="btn btn-primary">
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    `;

    $("#Norma").change(function(){
        let opcion = $("#Norma").val();
        if(opcion == "085MG" || opcion == "085ML"){
            $('#tablas').html(tabla);
            filas();
        }else{
            $('#tablas').empty();
        }
    });

    

    function filas(){
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
    }
    
});