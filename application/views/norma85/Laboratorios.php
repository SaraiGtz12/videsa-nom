<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vista Previa - Informe</title>
    <style>
        .data-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Vista Previa de Datos del Informe</h1>
    
    <div class="data-section">
        <h2>Datos Básicos</h2>
        <pre><?php print_r($numero_informe, $orden_servicio, $fecha_evaluacion, $recepcion, $fecha_informe); ?></pre>
    </div>

    <div class="data-section">
        <h2>Promedios de Campo</h2>
        <table class="data-table">
            <tr>
                <th>NOx</th>
                <th>CO</th>
                <th>O2</th>
                <th>CO2</th>
                <th>Temperatura</th>
            </tr>
            <tr>
                <td><?= $promedios_campo['nox'] ?></td>
                <td><?= $promedios_campo['co'] ?></td>
                <td><?= $promedios_campo['o2'] ?></td>
                <td><?= $promedios_campo['co2'] ?></td>
                <td><?= $promedios_campo['temp'] ?></td>
            </tr>
        </table>
    </div>

    <div class="data-section">
        <h2>Estratificación</h2>
        <h3>Marcado de Sonda</h3>
        <table class="data-table">
            <tr>
                <th>16.7%</th>
                <th>50%</th>
                <th>83.3%</th>
            </tr>
            <tr>
                <td><?= $estratificacion['marcado_sonda']['marcado1'] ?> m</td>
                <td><?= $estratificacion['marcado_sonda']['marcado2'] ?> m</td>
                <td><?= $estratificacion['marcado_sonda']['marcado3'] ?> m</td>
            </tr>
        </table>

        <h3>Concentraciones</h3>
        <table class="data-table">
            <tr>
                <th>Muestra 1</th>
                <th>Muestra 2</th>
                <th>Muestra 3</th>
                <th>Promedio</th>
            </tr>
            <tr>
                <td><?= $estratificacion['concentraciones']['concentracion1'] ?></td>
                <td><?= $estratificacion['concentraciones']['concentracion2'] ?></td>
                <td><?= $estratificacion['concentraciones']['concentracion3'] ?></td>
                <td><?= $estratificacion['concentraciones']['promedio'] ?></td>
            </tr>
        </table>

        <h3>Porcentajes de Estratificación</h3>
        <table class="data-table">
            <tr>
                <th>Muestra 1</th>
                <th>Muestra 2</th>
                <th>Muestra 3</th>
                <th>Máximo</th>
            </tr>
            <tr>
                <td><?= $estratificacion['porcentajes']['estratificacion1'] ?>%</td>
                <td><?= $estratificacion['porcentajes']['estratificacion2'] ?>%</td>
                <td><?= $estratificacion['porcentajes']['estratificacion3'] ?>%</td>
                <td><?= $estratificacion['porcentajes']['maxima'] ?>%</td>
            </tr>
        </table>
    </div>
</body>
</html>