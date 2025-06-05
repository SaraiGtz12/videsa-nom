<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        caption {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php 
        echo "Promedio de los Datos de Campo";

        $diametroIntC = 0.50;
        $extencionPuerto = 0.07;

        $total_muestras = count($datos['mediciones']);
        $suma_nox = 0;
        $suma_co = 0;
        $suma_o2 = 0;
        $suma_co2 = 0;
        $suma_temp = 0;
        
        foreach($datos['mediciones'] as $muestra) {
            $suma_nox += $muestra['nox'];
            $suma_co += $muestra['co'];
            $suma_o2 += $muestra['o2'];
            $suma_co2 += $muestra['co2'];
            $suma_temp += $muestra['temp_conducto'];
        }
        
        $promedio_nox = $suma_nox / $total_muestras;
        $promedio_co = $suma_co / $total_muestras;
        $promedio_o2 = $suma_o2 / $total_muestras;
        $promedio_co2 = $suma_co2 / $total_muestras;
        $promedio_temp = $suma_temp / $total_muestras;

        $ConcentracionPpm1 = 48.2;
        $ConcentracionPpm2 = 50.2;
        $ConcentracionPpm3 = 51.8;
        $ConcentracionPromedio = ($ConcentracionPpm1+$ConcentracionPpm2+$ConcentracionPpm3)/3;
        
        echo "<br>Promedio NOx: " . round($promedio_nox, 2);
        echo "<br>Promedio CO: " . round($promedio_co, 2);
        echo "<br>Promedio O2: " . round($promedio_o2, 2);
        echo "<br>Promedio CO2: " . round($promedio_co2, 2);
        echo "<br>Promedio Temp " . round($promedio_temp, 2);
    
        $estratificacion1 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm1) / $ConcentracionPromedio) * 100;
        $estratificacion2 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm2) / $ConcentracionPromedio) * 100;
        $estratificacion3 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm3) / $ConcentracionPromedio) * 100;
    
    ?>
    <table border="1">
        <caption>Determinación de la estratificación</caption>
        <thead>
            <tr>
                <th>Analito / Nox</th>
                <th>Marcado</th>
                <th>Concentración (ppm o %vol)</th>
                <th>%Estratificación</th>
                <th>ppm</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>16.7% de longitud del diámetro</td>
                <td><?= number_format((($diametroIntC*(1/6))+$extencionPuerto),2) ?></td>
                <td><?= $ConcentracionPpm1?></td>
                <td><?= number_format(($estratificacion1),2);?></td>
                <td><?= number_format((abs($ConcentracionPromedio-$ConcentracionPpm1)),2);?></td>
            </tr>
            <tr>
                <td>50% de longitud del diámetro</td>
                <td><?= number_format((($diametroIntC*(1/2))+$extencionPuerto),2) ?></td>
                <td><?= $ConcentracionPpm2?></td>
                <td><?= number_format(($estratificacion2),2);?></td>
                <td><?= number_format((abs($ConcentracionPromedio-$ConcentracionPpm2)),2);?></td>
            </tr>
            <tr>
                <td>83.3% de longitud del diámetro</td>
                <td><?= number_format((($diametroIntC*(5/6))+$extencionPuerto),2) ?></td>
                <td><?= $ConcentracionPpm3?></td>
                <td><?= number_format(($estratificacion3),2);?></td>
                <td><?= number_format((abs($ConcentracionPromedio-$ConcentracionPpm3)),2);?></td>
            </tr>
            <tr>
                <td colspan="2">Promedio</td>
                <td><?= $ConcentracionPromedio?></td>
                <td colspan="2">Maximo</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>