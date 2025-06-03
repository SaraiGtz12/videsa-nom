<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Datos de Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container rounded shadow mt-3 mb-3 p-4 bg-light">
        <div class="text-center mb-3">
            <h3>Captura de Datos de Campo</h3>
        </div>
        <form action="">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
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
                </table>
                <div class="d-grid">
                    <input type="submit" value="Agregar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.1.js"></script>
    <script src="<?=asset_url()?>js/norma85/forms/formulario2.js"></script>
</body>
</html>