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

         <table class="result-table ">
            <tr>
                <th colspan="5" style = "text-align: center">Resultados</th>
            </tr>
            <tr>
                <td>Parámetros Evaluados</td>
                <td>Concentración (ppmv)</td>
                <td>Limite Máximo Permisible (ppmv)</td>
                <td>Comparación (L.M.P.)</td>
                <td>&plusmn; uE (ppmv)</td>
            </tr>
            <tr>
                <td>Óxido de Nitrógeno (NOx)</td>
                <td><?= $concentracion?></td>
                <td>No Aplica</td>
                <td><?= $estratificacion?></td>
                <td><?= $ppm?></td>
            </tr>
            <!-- <tr>
                <td>Óxido de Nitrógeno (NOx)</td>
                <td>21.73</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.12</td>
            </tr> -->
        </table>

        <div style="margin-top: 20px; font-size: 7px;">
            NOTA 1: La incertidumbre estimada UE para CO es 1.86% y para NOx es 0.54%, se expresa con un factor de cobertura k=2 que corresponde aproximadamente 
            a un nivel de confianza del 95%. Se calcula basandose en la guia para la expresion de incertidumbre en los resultados de las mediciones (NMX-CH-140-IMNC-202)
            <br>
            NOTA 2: Para este caso, la zona geografica para el Monoxido de Carbono (CO) se considera: Resto del Pais (RP).
            <br>
            NOTA 3:Para este caso, la zona geografica para los Oxidos de Nitrogeno (NOx) se considera: Resto del Pais (RP).
            <br>
            NOTA 4: ppmv Partes por millon volumen, igual a micromol por mol 
            <br>
            GJ/has      Giga Joules por hora
            <br>
            C.C         Caballos Caldera 
            <br>
            *Para este caso de CO NOx los limites se establecen como concentraciones en volumen y 
            base seca, en condiciones de refrencia de 25&deg;C, 101 325 pascales (1 atm) y 5% de (O2)
        </div>

        <table class="evaluated-equipment-table">
            <tr>
                <th colspan="6" style = "text-align: center">CONCLUSION</th>
            </tr>
            <tr>
                <td colspan="6" style = "text-align: center; font-size: 8px;">
                    Debido a que el equipo evaluado no es un equipo de calentamiendo indirecto,
                    la NOM-085-SEMARNAT-2011 no le aplica, se inclutye el resultado de la contratacion
                    de los parametros evaluados, unicamente con el objetivo de proporcionar infomracion
                    relativa a los resultados obtenidos. La evaluacion se realiza a solictud del cliente.
                </td>
            </tr>
        
        </table>

        <div style="text-align: center; margin-top: 30px;">
            <p>Firma Electrónica</p>
             {!! $qr !!}
            <p>Escanea para verificar</p>
        </div>
        <?php $this->load->view('pdf/recursos/footerCaratula'); ?>


        <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerCaratula'); ?>
        <?php $this->load->view('pdf/recursos/footerCaratula'); ?>


        <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerGeneral'); ?>
        <?php $this->load->view('pdf/recursos/footerGeneral'); ?>


         <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerGeneral'); ?>
        <?php $this->load->view('pdf/recursos/footerGeneral'); ?>


         <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerGeneral'); ?>
        <?php $this->load->view('pdf/recursos/footerGeneral'); ?>


         <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerGeneral'); ?>
        <?php $this->load->view('pdf/recursos/footerGeneral'); ?>

        
         <div style="page-break-before: always;"></div>
        <?php $this->load->view('pdf/recursos/headerGeneral'); ?>
        <?php $this->load->view('pdf/recursos/footerGeneral'); ?>



    </main>
</body>
</html>
