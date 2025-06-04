<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe PDF</title>
    <style>
         @page {
            margin: 100px 50px 120px 50px;

             @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 10px;
                color: #333;
            }
        }

       header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -100px;
            left: 0;
            right: 0;
            height: 100px;
            font-size: 9px;
            text-align: center;
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

        .divider {
            border-top: 1px solid black;
            margin: 5px 0;
        }
        main {
            margin-top: 100px;
            margin-bottom: 120px; /* Igual que el espacio del footer */
        }
      

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }

       

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .divider {
            border-top: 1px solid black;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 9px;
            text-align: justify;
            margin-bottom: 20px;
        }

        .company-name {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
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
        .top-section {
        text-align: left;
        margin-bottom: 10px;
        }

        .logo {
            margin-bottom: 5px;
           
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 10px;
            text-align: left;
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
    @if ($modo === 'web')
        <form action="{{ url('/generate085ML') }}" method="GET" style="text-align: right;">
            <input type="hidden" name="descargar" value="1">
            <button type="submit">Descargar PDF</button>
        </form>
    @endif
  

 <!-- inicio de encabezado-->
    <header>
        <div class="top-section">

            <div class="logo">
                 <img style="width: 100px;" src="data:image/jpeg;base64,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 ">
            </div>
            <div class="title">Informe de Resultados</div>
        </div>

    
        <div class="divider"></div>

        <div class="subtitle"> 
            Comparación con la Norma Oficial Mexicana NOM-085-SEMARNAT-2011, Contaminación atmosférica — Niveles máximos permisibles de emisión de los equipos de combustión de calentamiento indirecto y su medición.
            <br>
            Para equipos con capacidad térmica nominal mayor de 5.3 G/J o 150 C.C combustible gaseoso
        </div>
    </header>
    <!-- fin de encabezado-->
     
 <!-- pie de pagina-->
    <footer>
        <div>
            <div style="text-align: left;">
                FC-AAR-006<br>
                Revisión: 23
            </div>
            <div style="text-align: right;">
                Página <span class="page"></span> de <span class="topage"></span>
            </div>
        </div>

        <hr style="border: 0; border-top: 2px solid black; margin: 10px 0;">
        <hr style="border: 0; border-top: 2px solid black; margin: 0 0 10px 0;">

        <div style="text-align: center; font-size: 9px; line-height: 1.4;">
            <strong>Verificaciones Industriales y Desarrollo de Proyectos Ecológicos S.A. de C.V.</strong><br>
            Revolución No.356, Col. La Romana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; e-mail: verificaciones@prodigy.net.mx<br>
            CP. 54030, Tlalnepantla, Estado de México &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; www.videsa.net<br>
            Tel: 01(55) 5565-5044, con 13 líneas
        </div>
    </footer>

 <!-- fin de pie de pagina -->
    <main>
        <div class="company-name">
            TEQUILERA MILAGRO, S.A DE C.V
        </div>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    Camino a la Purisima Km, 2 S/N, Predio el Tigre, Atotonilco,<br>
                    Jalisco, C.P. 47750<br>
                    Resto de país (RP)
                </td>
                <td class="col-2">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de muestreo:<br>
                    Fecha de Recepción:<br>
                    Fecha de Análisis:<br>
                    Fecha de informe:
                </td>
                  <td class="col-3">
                    {{ $numero_informe }}<br>
                    {{ $orden_servicio }}<br>
                    {{ $fecha_evaluacion }}<br>
                    {{ $fecha_recepcion }}<br>
                    {{ $fecha_analisis }}<br>
                    {{ $fecha_informe }}
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
                <td colspan="6" style = "text-align: center">Caldera Powermaster</td>
            </tr>
            <tr>
                <td>Capacidad térmica</td>
                <td>C.C</td>
                <td>GJ/h</td>
                <td></td>
                <td>Combustible utilizado</td>
                <td>Combustóleo Pesado</td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>600</td>
                <td>No.Disponible</td>
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
                <td>Resultado (ppmv)</td>
                <td>Limite Máximo Permisible (ppmv)</td>
                <td>Comparación (L.M.P.)</td>
                <td>&plusmn; uE (ppmv)</td>
            </tr>
            <tr>
                <td>Mónoxido de Carbono (CO)</td>
                <td>20.08</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.37</td>
            </tr>
            <tr>
                <td>Óxido de Nitrógeno (NOx)</td>
                <td>21.73</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.12</td>
            </tr>
            <tr>
                <td>Bióxido de Azufre (So2)</td>
                <td>21.73</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.12</td>
            </tr>
            <tr>
                <td></td>
                <td>21.73</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.12</td>
            </tr>
            <tr>
                <td>Particulas Suspendidas Totales PST's</td>
                <td>21.73</td>
                <td>No Aplica</td>
                <td>No Aplica</td>
                <td>0.12</td>
            </tr>
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



        <!-- esto iria en mi segunda pagina  -->
         <div style="page-break-before: always;"></div>

        <table style="margin-top: 110px;margin-left: auto;">
            <tr>
            
                <td class="col-1">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                <td class="col-2">
                    FE085MG/250405-01<br>
                    25-1347<br>
                    5-ABRIL-25<br>
                    6-ABRIL-25<br>
                    11-ABRIL-25
                </td>
        
            </tr>
        </table>
        <table class="result-table " >
            <tr>
                <th colspan="6" style = "text-align: center">TABLA DE RESULTADOS</th>
            </tr>
            <tr>
                <td></td>
                <td>NOx ppmv</td>
                <td>CO ppmv</td>
                <td>O2% vol</td>
                <td>CO2%vol</td>
                <td>TEMP. En el coducto C</td>
            </tr>
            <tr>
                <td>Promedio de los valores obtenidos</td>
                <td>8.59</td>
                <td>7.80</td>
                <td>16.42</td>
                <td>1.88</td>
                <td>95.1</td>
            </tr>
            <tr>
            <td>Valores corregidos por gas efluente</td>
                <td>8.06</td>
                <td>7.45</td>
                <td>16.33</td>
                <td>N/A</td>
                <td>N/A</td>
            </tr>
            <tr>
            <td>Valores corregidos al 5% de O2</td>
                <td>21.73</td>
                <td>20.08</td>
                <td>N/A</td>
                <td>5.08</td>
                <td>N/A</td>
            </tr>
        </table>
        <table style="margin: 20px auto; text-align: center;">
            <tr>
                <td class="col-1">
                    C_R=20.9-0-R/<br>
                    20.9-0_M*C_M<br>
                </td>
                <td class="col-2">
                    CR=&nbsp; 20.9-5.0<br>
                    &nbsp;--------------<br>
                    &nbsp; 20.9-15.00<br>
                </td>
                <td class="col-2">
                    *
                </td>
                <td class="col-2">
                    8.06 = 21.73 ppmv
                </td>
            </tr>
        </table>


        <table class="evaluated-equipment-table">
        
            <tr>
                <td>Concentración de referencia del O2</td>
                <td></td>
                <td>Valores de referencia</td>
                <td></td>
            </tr>
            <tr>
                <td>Nivel de referencia para el O2 (5%) </td>
                <td>5.0</td>
                <td></td>
                <td>O2%</td>
            </tr>
            <tr>
                <td>Valor medido para O2 (%)</td>
                <td>15.0</td>
                <td></td>
                <td>OR%</td>
            </tr>
            <tr>
                <td>Concentración medida</td>
                <td>8.1</td>
                <td></td>
                <td>OM%</td>
            </tr>
        </table>

        <div style="margin-top: 20px; font-size: 8px;">
            *Para valores de OM medidos entre 15.1% y 20.9%, se utilizará un valor de OM de 15%
            <br><br><br>
            Método 3A EPA-2008 &nbsp; Determinación de oxígeno (O2) y bióxido de carbono (CO2) en los gases que 
            fluyen por un conducto. Método instrumenta
            <br>
            Método 10 EPA-2008&nbsp;Para el caso de CO y NOx los límites se establecen como concentraciones en volumen y en base seca, 
            en condiciones de referencia de 25°C, 101 325 Pa (1 atm) y 5 % de
            Método 7 EPA-2008&nbsp;Determinación de óxidos de nitrógeno, en los gases que fluyen por un conducto.
            Método de quimiluminiscencia
        </div>
    </main>
        


    

</body>
</html>