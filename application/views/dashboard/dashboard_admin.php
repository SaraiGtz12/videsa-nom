 	
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);
google.charts.setOnLoadCallback(drawStuff);
google.charts.setOnLoadCallback(drawStuff1);


// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Rechazado', 2],
  ['Aceptado', 8],

]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'% de Aceptacion y % de Rechazo', 'width':550, 'height':215};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}


//TIPOS DE SERVICIO
function drawChart1() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Mantenimiento Basico', 2],
  ['Reparacion con Parte', 8],
  ['Irreparable', 8],
  ['Rechazo', 8],
]);
  // Optional; add a title and set the width and height of the chart
  var options = {
    'title':'% de Aceptacion y % de Rechazo', 'width':550, 'height':215




};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
  chart.draw(data, options);
}
//TIPOS DE SERVICIO


      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Mover','Porcentaje'],
          ["Huawei",45],
          ["Samsung",40],
          ["Motorola",35],
          ["Sony",30],
          ['Matel',25],
          ['ZTE',20],
          ['LG',15],
          ['Hissense',10],
          ['Nokia',5]
        ]);

        var options = {
          width: 550,
          height:250,
          legend: { position: 'none' },
          chart: {
            title: '% Ingresos por Marca',
            subtitle: 'Datos acumulados en el mes actual' },
          axes: {
             x:
            {
              0: { side: 'top', label: 'Marcas'}
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };


      function drawStuff1() {
        var data = new google.visualization.arrayToDataTable([
          ['Mover','Porcentaje'],
          ["1",45],
          ["2",40],
          ["3",35],
          ["4",30],
          ['5',25],
          ['6',20],
          ['7',15],
          ['8',10],
          ['9',5]
        ]);

        var options = {
          width: 550,
          height:250,
          legend: { position: 'none' },
          chart: {
            title: 'TAT Solicitudes',
            subtitle: 'Datos acumulados en el mes actual' },
          axes: {
             x:
            {
              0: { side: 'top', label: '---'}
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div1'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };



</script>



<script>
    
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);



</script>





    <!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->

                <!-- END Page Header -->
                <!-- Page Content -->
                <div class="content">


                    <div class="row">

                        <div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">
                                      <div class="h1 push-15-t push-5">Monto Facturado</div>
                                  <hr>
    <div class="h1 push-15-t push-5">$ 25,359.00</div>
                                  
                                </div>
                            </a>
                        </div>







						<div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">

                                  
                                    <div>
                                        <img  src="<?=asset_url()?>img/Videsa.png" alt="">
                                    </div>
                                  
                                </div>
                            </a>
                        </div>




                        <div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">
                                      <div class="h5 push-15-t push-5"></div>
                                  
                                    <div>
                                      <div id="piechart"></div>
                                    </div>
                                  
                                </div>
                            </a>
                        </div>






                        <div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">
                                      <div class="h5 push-15-t push-5"></div>
                                  
                                    <div>
                                      <div id="piechart1"></div>
                                    </div>
                                  
                                </div>
                            </a>
                        </div>



                        <div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">                                  
                                    <div>
                           <div id="top_x_div"></div>
                                    </div>
                                  
                                </div>
                            </a>
                        </div>



                        <div class="col-md-3col-sm-6 col-lg-6">
                            <a class="block block-link-hover2" href="#">
                                <div class="block-content block-content-full text-center">                                  
                                    <div>
                           <div id="top_x_div1"></div>
                                    </div>
                                  
                                </div>
                            </a>
                        </div>



					</div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
			<script type="text/javascript">
				jQuery(document).ready(ordenes_functions);
			</script>