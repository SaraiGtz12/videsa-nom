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
    @if ($modo === 'web')
        <form id="formImagenesGraficas" action="{{ url('/generate085MG') }}" method="POST" style="text-align: right; position: relative; z-index: 10;">
            @csrf
            <input type="hidden" name="descargar" value="1">
            <input type="hidden" name="grafica_co" id="inputGraficaCO">
            <input type="hidden" name="grafica_o2" id="inputGraficaO2">
            <input type="hidden" name="grafica_co2" id="inputGraficaCO2">
            <button type="submit">Descargar PDF</button>
        </form>

    @endif
    <main>
        @include('pdf.recursos.headerCaratula')
        <div class="company-name">
            Flexico, S. de R.L. de C.V.
        </div>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    Carretera Jilotepec–Soyaniquilpan Km 3.5 MZ 2 Lt 1B, Parque industrial Jilotepec,<br>
                    Jilotepec, Estado de México, C.P. 54240<br>
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
                    {{ $numero_informe }}<br>
                    {{ $orden_servicio }}<br>
                    {{ $fecha_evaluacion }}<br>
                    {{ $recepcion }}<br>
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
                <td colspan="6" style = "text-align: center">Plancha 3</td>
            </tr>
            <tr>
                <td>Capacidad térmica</td>
                <td>C.C</td>
                <td>GJ/h</td>
                <td></td>
                <td>Combustible utilizado</td>
                <td>Gas natural</td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>No.Disponible</td>
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
                <td>Cconcentración (ppmv)</td>
                <td>Limite Máximo Permisible (ppmv)</td>
                <td>Comparación (L.M.P.)</td>
                <td>&plusmn; uE (ppmv)</td>
            </tr>
            <tr>
                <td>Monoxido de Carbono (CO)</td>
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

    @include('pdf.recursos.footerCaratula')

        <!-- esto iria en mi segunda pagina  -->
    <div style="page-break-before: always;"></div>
    @include('pdf.recursos.headerCaratula')

        <table style="margin-top: 40px;margin-left: auto;">
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
     @include('pdf.recursos.footerCaratula')              
    <div style="page-break-before: always;"></div>
    <!-- paginas 3 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')              
    <div style="page-break-before: always;"></div>
     <!-- paginas 4 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')  
    <div style="page-break-before: always;"></div>
    <!-- paginas 5 -->
    @include('pdf.recursos.headerGeneral')

        <div style="margin-top: 20px">
           @if ($modo === 'pdf')
                <!-- Diseño con tabla para compatibilidad en PDF -->
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <!-- Tabla de ANALITO -->
                            <table style="width: 100%; margin-top: 40px; border-collapse: collapse; border: 1px solid black;">
                                <thead>
                                    <tr>
                                        <th colspan="5" style="text-align: center; border: 1px solid black; padding: 8px;">ANALITO</th>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid black; padding: 6px;">No.</th>
                                        <th style="border: 1px solid black; padding: 6px;">CO (ppmv)</th>
                                        <th style="border: 1px solid black; padding: 6px;">O2%</th>
                                        <th style="border: 1px solid black; padding: 6px;">CO2 %</th>
                                        <th style="border: 1px solid black; padding: 6px;">TEMP, °C</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analito_no as $i => $no)
                                        <tr>
                                            <td style="border: 1px solid black; padding: 6px;">{{ $no }}</td>
                                            <td style="border: 1px solid black; padding: 6px;">{{ $analito_CO[$i] }}</td>
                                            <td style="border: 1px solid black; padding: 6px;">{{ $analito_O2[$i] }}</td>
                                            <td style="border: 1px solid black; padding: 6px;">{{ $analito_CO2[$i] }}</td>
                                            <td style="border: 1px solid black; padding: 6px;">{{ $analito_temp[$i] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="border: 1px solid black; padding: 6px; font-weight: bold;">Promedio</td>
                                        <td style="border: 1px solid black; padding: 6px;">
                                            {{ number_format(array_sum($analito_CO) / count($analito_CO), 2) }}
                                        </td>
                                        <td style="border: 1px solid black; padding: 6px;">
                                            {{ number_format(array_sum($analito_O2) / count($analito_O2), 2) }}
                                        </td>
                                        <td style="border: 1px solid black; padding: 6px;">
                                            {{ number_format(array_sum($analito_CO2) / count($analito_CO2), 2) }}
                                        </td>
                                        <td style="border: 1px solid black; padding: 6px;">
                                            {{ number_format(array_sum($analito_temp) / count($analito_temp), 2) }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                        <td style="width: 50%; vertical-align: top; padding-left: 20px;">
                            <!-- Gráficas -->
                            <img src="{{ $grafica_co }}" width="300" style="display: block; margin-bottom: 20px;">
                            <img src="{{ $grafica_o2 }}" width="300" style="display: block; margin-bottom: 20px;">
                            <img src="{{ $grafica_co2 }}" width="300" style="display: block;">
                        </td>
                    </tr>
                </table>
            @else
                <!-- Vista web normal -->
                <div style="display: flex; gap: 40px; align-items: flex-start;">
                    <table style="width: 50%; margin-top: 40px; border-collapse: collapse; border: 1px solid black;">
                        <thead>
                            <tr>
                                <th colspan="5" style="text-align: center; border: 1px solid black; padding: 8px;">ANALITO</th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black; padding: 6px;">No.</th>
                                <th style="border: 1px solid black; padding: 6px;">CO (ppmv)</th>
                                <th style="border: 1px solid black; padding: 6px;">O2%</th>
                                <th style="border: 1px solid black; padding: 6px;">CO2 %</th>
                                <th style="border: 1px solid black; padding: 6px;">TEMP, °C</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($analito_no as $i => $no)
                                <tr>
                                    <td style="border: 1px solid black; padding: 6px;">{{ $no }}</td>
                                    <td style="border: 1px solid black; padding: 6px;">{{ $analito_CO[$i] }}</td>
                                    <td style="border: 1px solid black; padding: 6px;">{{ $analito_O2[$i] }}</td>
                                    <td style="border: 1px solid black; padding: 6px;">{{ $analito_CO2[$i] }}</td>
                                    <td style="border: 1px solid black; padding: 6px;">{{ $analito_temp[$i] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="border: 1px solid black; padding: 6px; font-weight: bold;">Promedio</td>
                                <td style="border: 1px solid black; padding: 6px;">
                                    {{ number_format(array_sum($analito_CO) / count($analito_CO), 2) }}
                                </td>
                                <td style="border: 1px solid black; padding: 6px;">
                                    {{ number_format(array_sum($analito_O2) / count($analito_O2), 2) }}
                                </td>
                                <td style="border: 1px solid black; padding: 6px;">
                                    {{ number_format(array_sum($analito_CO2) / count($analito_CO2), 2) }}
                                </td>
                                <td style="border: 1px solid black; padding: 6px;">
                                    {{ number_format(array_sum($analito_temp) / count($analito_temp), 2) }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div style="width: 50%; display: flex; flex-direction: column; gap: 20px; margin-top: 40px;">
                        <canvas id="graficaCO" width="400" height="200"></canvas>
                        <canvas id="graficaO2" width="400" height="200"></canvas>
                        <canvas id="graficaCO2" width="400" height="200"></canvas>
                    </div>
                </div>
            @endif
        </div>
    @include('pdf.recursos.footerGeneral')  
    <div style="page-break-before: always;"></div>

     <!-- paginas 6 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')              
    <div style="page-break-before: always;"></div>
     <!-- paginas 7 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')  
    </main>
<script>
    const analitoData = {
        no: @json($analito_no),
        co: @json($analito_CO),
        o2: @json($analito_O2),
        co2: @json($analito_CO2)
    };
</script>
<script src="{{ asset('js/pdf/grafica-resultados.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>