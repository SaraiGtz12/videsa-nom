<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe PDF</title>
     <style>
         @page {
            margin: 10px 40px 40px 40px;

             @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 10px;
                color: #333;
            }
        }
        .page:before {
            content: counter(page);
        }

        .topage:before {
            content: counter(pages);
        }

        .page-number {
            text-align: right;
            font-size: 9px;
        }
        main {
            margin-top: 0;
            margin-bottom: 0;
        }
      

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }
        .company-name {
            font-weight: bold;
            font-size: 12px;
            margin-top: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-table td {
            vertical-align: top;
            padding: 5px;
        }

        .col-1 {
            width: 35%;
        }

        .col-2 {
            width: 20%;
            font-weight: bold;
        }

        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 20%;
            text-align: right;
        }

        .placeholder-image {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            display: inline-block;
            text-align: center;
            line-height: 100px;
            color: #666;
            font-size: 8px;
            border: 1px solid #999;
        }
   

        .evaluated-equipment-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 50px;
            font-size: 9px;
        }

        .evaluated-equipment-table th,
        .evaluated-equipment-table td {
            border: none;
            padding: 5px;
            text-align: left;
        }

        .evaluated-equipment-table tr:first-child th {
            border: 1px solid #000;
            background-color: #f2f2f2; 
            text-align: center;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9x;
            margin-top: 10px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <main>
        <?php $this->load->view('pdf/recursos/headerCaratula'); ?>
        <div class="company-name">
            <?= $razon_social ?>
        </div>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    <?= $calle ?>, <?= $colonia ?>,<br>
                    <?= $alcaldia ?>, <?= $estado ?>, C.P. <?= $cp ?><br>
                    Resto de país (Rp)
                </td>
                <td class="col-2">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                <td class="col-3">
                    <?= $numero_informe ?><br>
                    <?= $orden_servicio ?><br>
                    <?= $fecha_evaluacion ?><br>
                    <?= $recepcion ?><br>
                    <?= $fecha_informe ?>
                </td>
                <td class="col-4">
                    <div class="placeholder-image">QR</div>
                </td>
            </tr>
        </table>

         <table class="evaluated-equipment-table">
            <tr>
                <th colspan="6" style = "text-align: center">Equipo evaluado</th>
            </tr>
            <tr>
                <td colspan="6" style = "text-align: center"><?= $equipo_evaluado?></td>
            </tr>
            <tr>
                <td>Capacidad</td>
                <td>C.C</td>
                <td>GJ/h</td>
                <td></td>
                <td>Combustible utilizado</td>
                <td><?=$combustible?></td>
            </tr>
            <tr>
                <td>térmica</td>
                <td><?= $marca?></td>
                <td><?= $marca?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <?php $this->load->view('pdf/recursos/footerCaratula'); ?>
    </main>
</body>
</html>
