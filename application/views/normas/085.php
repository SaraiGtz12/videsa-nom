<main id="main-container">
  <div class="content">
    <h1>Captura de Norma 085</h1>
    <hr>
    <style>
      .acordeon {
        width: 100%;
      }

      .acordeon-item {
        border: 1px solid #ccc;
        margin-bottom: 5px;
      }

      .acordeon-header {
        background-color: #f1f1f1;
        padding: 10px;
        cursor: pointer;
      }

      .acordeon-content {
        display: none;
        padding: 10px;
        background-color: #fff;
      }
    </style>
    <div class="acordeon">
      <div class="acordeon-item">
        <div class="acordeon-header">Datos del Cliente</div>
        <div class="acordeon-content">
          <div class="row">
            <div class="col-md-12">
              <div id="div1">
                <form id="form1">
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label>Número de Informe:</label>
                      <input type="text" class="form-control" name="numero_informe" value="FE085MG/250405-01">
                    </div>
                    <div class="col-md-4">
                      <label>Orden de Servicio:</label>
                      <input type="text" class="form-control" name="orden_servicio" value="25-1347">
                    </div>
                    <div class="col-md-4">
                      <label>Fecha de Evaluación:</label>
                      <input type="date" class="form-control" name="fecha_evaluacion" value="2025-04-13">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label>Recepción:</label>
                      <input type="date" class="form-control" name="recepcion" value="2025-04-06">
                    </div>
                    <div class="col-md-6">
                      <label>Fecha de Informe:</label>
                      <input type="date" class="form-control" name="fecha_informe" value="2025-04-13">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label>Razón Social:</label>
                      <input type="text" class="form-control" name="razon_social" value="Flexico, S. de R.L. de C.V.">
                    </div>
                    <div class="col-md-6">
                      <label>Calle y Número:</label>
                      <input type="text" class="form-control" name="calle"
                        value="Carretera Jilotepec -Soyaniquilpan Km 3.5, Mz. 2 Lt. 1B">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label>Colonia:</label>
                      <input type="text" class="form-control" name="colonia" value="Parque Industrial Jilotepec">
                    </div>
                    <div class="col-md-4">
                      <label>Alcaldía o Municipio:</label>
                      <input type="text" class="form-control" name="alcaldia" value="Jilotepec">
                    </div>
                    <div class="col-md-4">
                      <label>Estado:</label>
                      <input type="text" class="form-control" name="estado" value="Estado de México">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label>Código Postal:</label>
                      <input type="text" class="form-control" name="cp" value="54240">
                    </div>
                    <div class="col-md-4">
                      <label>Responsable:</label>
                      <input type="text" class="form-control" name="responsable" value="Juan Fernando Romero Martínez">
                    </div>
                    <div class="col-md-4">
                      <label>Cargo:</label>
                      <input type="text" class="form-control" name="cargo" value="Jefe de HSE">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label>Teléfono:</label>
                      <input type="text" class="form-control" name="telefono" value="55 55 80 80 00">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Información del equipo</div>
      <div class="acordeon-content">
        <div id="div2">
          <form id="form2">
            <div class="row mb-3">
              <div class="col-md-6">
                <label>Equipo evaluado:</label>
                <input type="text" class="form-control" name="equipo_evaluado" value="Plancha 3">
              </div>
              <div class="col-md-6">
                <label>Marca y Modelo:</label>
                <input type="text" class="form-control" name="marca" value="No disponible">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label>Combustible Utilizado:</label>
                <input type="text" class="form-control" name="combustible" value="Gas Natural">
              </div>
              <div class="col-md-6">
                <label>Capacidad térmica nominal:</label>
                <input type="text" name="capacidad_termica" class="form-control" value="Gas Natural">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label>Altura msnm:</label>
                <input type="text" name="altura" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Presión estática:</label>
                <input type="text" name="presion" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Año:</label>
                <input type="text" name="anio" class="form-control" value="2">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label>Presión Barométrica:</label>
                <input type="text" name="presion_barometrica" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Geometría del conducto:</label>
                <input type="text" name="geometria_conductor" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Diámetro interior del conducto, Dch:</label>
                <input type="text" name="diametro_interior_conducto" class="form-control" value="2">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label>Diámetro equivalente, Deq:</label>
                <input type="text" name="diametro_equivalente" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Largo transversal, L1:</label>
                <input type="text" name="L1" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Ancho transversal, L2:</label>
                <input type="text" name="L2" class="form-control" value="2">
              </div>
            </div>
            <!-- aqui -->
            <div class="row mb-3">
              <div class="col-md-4">
                <label>Número de puertos:</label>
                <input type="text" name="no_puertos" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Distancia en A:</label>
                <input type="text" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Distancia en B:</label>
                <input type="text" class="form-control" value="2">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label>Distancia en C:</label>
                <input type="text" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Extensión del puerto, epm:</label>
                <input type="text" class="form-control" value="2">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label>Número de diámetros en A:</label>
                <input type="text" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Número de diámetros en B:</label>
                <input type="text" class="form-control" value="2">
              </div>
              <div class="col-md-4">
                <label>Número de diámetros en C:</label>
                <input type="text" class="form-control" value="2">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label>Número de puntos seleccionados para medición de gases:</label>
                <input type="text" class="form-control" value="2">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Determinación de la estratificación</div>
      <div class="acordeon-content">
        <div id="div3">
          <table class="table" border="1" cellpadding="5" cellspacing="0">
            <caption><strong>Analito: NOx</strong></caption>
            <thead>
              <tr>
                <th>Marcado de la sonda (m)</th>
                <th>Concentración (ppm o %vol.)</th>
                <th>% Estratificación</th>
                <th>ppm</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="number" step="0.001" value="0.03" class="form-control"></td>
                <td><input type="number" step="0.01" value="8.1" class="form-control"></td>
                <td><input type="number" step="0.01" value="4.33" class="form-control"></td>
                <td><input type="number" step="0.01" value="0.37" class="form-control"></td>
              </tr>
              <tr>
                <td><input type="number" step="0.001" value="0.075" class="form-control"></td>
                <td><input type="number" step="0.01" value="8.4" class="form-control"></td>
                <td><input type="number" step="0.01" value="0.79" class="form-control"></td>
                <td><input type="number" step="0.01" value="0.07" class="form-control"></td>
              </tr>
              <tr>
                <td><input type="number" step="0.001" value="0.13" class="form-control"></td>
                <td><input type="number" step="0.01" value="8.9" class="form-control"></td>
                <td><input type="number" step="0.01" value="5.12" class="form-control"></td>
                <td><input type="number" step="0.01" value="0.43" class="form-control"></td>
              </tr>

            </tbody>
            <tfoot>
              <tr>
                <td><strong>Promedio</strong></td>
                <td><input type="number" step="0.01" value="8.40" class="form-control"></td>
                <td><strong>Máximo</strong></td>
                <td>
                  <input type="number" step="0.01" value="0.43" class="form-control">
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Cálculo de Error (ACE)</div>
      <div class="acordeon-content">
        <div>
          <div class="mb-3">
            <h6>REspuesta de Calibración del Analizador (Cdir)</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="text-center">
                  O<sub>2</sub>%
                </div>
                <div class="mb-3">
                  <input type="number" name="CalculoErrorO2Txt1" id="CalculoErrorO2Txt1" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorO2Txt2" id="CalculoErrorO2Txt2" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorO2Txt3" id="CalculoErrorO2Txt3" step="0.01"
                    class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center">
                  CO ppmv
                </div>
                <div class="mb-3">
                  <input type="number" name="CalculoErrorCOTxt1" id="CalculoErrorCOTxt1" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorCOTxt2" id="CalculoErrorCOTxt2" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorCOTxt3" id="CalculoErrorCOTxt3" step="0.01"
                    class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center">
                  NOx ppmv
                </div>
                <div class="mb-3">
                  <input type="number" name="CalculoErrorNoxTxt1" id="CalculoErrorNoxTxt1" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorNoxTxt2" id="CalculoErrorNoxTxt2" step="0.01"
                    class="form-control">
                </div>
                <div class="mb-3">
                  <br>
                  <input type="number" name="CalculoErrorNoxTxt3" id="CalculoErrorNoxTxt3" step="0.01"
                    class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el NOx</div>
      <div class="acordeon-content">
        <div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>NOx (Cdir)</th>
                  <th>Respuesta Sistema</th>
                  <th>Tr(s)</th>
                  <th>Flujo L/min</th>
                  <th>Respuesta Sistema</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span>BAJA ppmv</span>
                    <input type="number" name="CalculoNoxCdir1" id="CalculoNoxCdir1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxRs1_1" id="CalculoNoxRs1_1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxTrs1" id="CalculoNoxTrs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxFlujo1" id="CalculoNoxFlujo1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxRs2_1" id="CalculoNoxRs2_1" step="0.01" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Media/Alta</span>
                    <input type="number" name="CalculoNoxCdir2" id="CalculoNoxCdir2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxRs1_2" id="CalculoNoxRs1_2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxTrs1" id="CalculoNoxTrs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxFlujo2" id="CalculoNoxFlujo2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoNoxRs2_2" id="CalculoNoxRs2_2" step="0.01" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el CO</div>
      <div class="acordeon-content">
        <div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>NOx (Cdir)</th>
                  <th>Respuesta Sistema</th>
                  <th>Tr(s)</th>
                  <th>Flujo L/min</th>
                  <th>Respuesta Sistema</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span>BAJA ppmv</span>
                    <input type="number" name="CalculoCoCdir1" id="CalculoCoCdir1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoRs1_1" id="CalculoCoRs1_1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoTrs1" id="CalculoCoTrs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoFlujo1" id="CalculoCoFlujo1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoRs2_1" id="CalculoCoRs2_1" step="0.01" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Media/Alta</span>
                    <input type="number" name="CalculoCoCdir2" id="CalculoCoCdir2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoRs1_2" id="CalculoCoRs1_2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoTrs1" id="CalculoCoTrs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoFlujo2" id="CalculoCoFlujo2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoCoRs2_2" id="CalculoCoRs2_2" step="0.01" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="acordeon-item">
      <div class="acordeon-header">Cálculo del Bias, Drift y medición del tiempo de respuesta y flujo para el O2</div>
      <div class="acordeon-content">
        <div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>NOx (Cdir)</th>
                  <th>Respuesta Sistema</th>
                  <th>Tr(s)</th>
                  <th>Flujo L/min</th>
                  <th>Respuesta Sistema</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span>BAJA ppmv</span>
                    <input type="number" name="CalculoO2Cdir1" id="CalculoO2Cdir1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Rs1_1" id="CalculoO2Rs1_1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Trs1" id="CalculoO2Trs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Flujo1" id="CalculoO2Flujo1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Rs2_1" id="CalculoO2Rs2_1" step="0.01" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Media/Alta</span>
                    <input type="number" name="CalculoO2Cdir2" id="CalculoO2Cdir2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Rs1_2" id="CalculoO2Rs1_2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Trs1" id="CalculoO2Trs1" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Flujo2" id="CalculoO2Flujo2" step="0.01" class="form-control">
                  </td>
                  <td>
                    <br>
                    <input type="number" name="CalculoO2Rs2_2" id="CalculoO2Rs2_2" step="0.01" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div id="div4">
      <h2>Captura de datos de campo</h2>
      <div class="text-center mb-3 mt-3">
      </div>
      <div>
        <div>
          <label for="normaSelect" class="form-label">Elige el tipo de formato que deseas</label>
          <select id="normaSelect" class="form-select w-100">
            <option value="">-- Selecciona una opcion --</option>
            <option value="085MG">085MG</option>
            <option value="085G">085G</option>
            <option value="085L">085L</option>
            <option value="085ML">085ML</option>
          </select>
        </div>
      </div>
      <div id="tablas">
      </div>
      <br><br><br>
      <hr>
      <button id="btnGuardar" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</main>

<script>
        document.querySelectorAll('.acordeon-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>


<script type="text/javascript">
				
  $(document).ready(function(){
    $('#normaSelect').select2({
        placeholder: "Selecciona una opción",
        width: '100%'
    });

    let tabla = `
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
                </table>
            </div>
    `;


    let tabla2 = `
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>N°</th>
                            <th>CO (ppmv)</th>
                            <th>O2(%)</th>
                            <th>CO<sub>2</sub> %</th>
                            <th>Temp, En el Conducto C°</th>
                        </tr>
                    </thead>
                    <tbody id="CamposRegistros2">
                        
                    </tbody>
                </table>
            </div>
    `;

      function filas2(){
          $("#CamposRegistros2").empty();

          for(let i=0;i<60; i++){
              let campo = ` 
                  <tr> 
                      <td>${i+1}</td> 
                      <td><input type="number" class="form-control" name="CO"/></td> 
                      <td><input type="number" class="form-control" name="O2" step="0.01"/></td> 
                      <td><input type="number" class="form-control" name="CO2" step="0.01"/></td> 
                      <td><input type="number" class="form-control" name="Temp" step="0.1"/></td> 
                  </tr>`; 

              $("#CamposRegistros2").append(campo);
          }
      }

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

      $("#normaSelect").change(function(){
          let opcion = $("#normaSelect").val();
          if(opcion == "085MG" || opcion == "085ML"){
              $('#tablas').html(tabla);
              filas();
          }else if(opcion == "085G" || opcion == "085L"){
              $('#tablas').html(tabla2);
              filas2();
          }
      });
      
  });

  $(document).ready(function () {
    $('#btnGuardar').on('click', function (e) {
      console.log("click");
      e.preventDefault();
      let normaSelect = $('#normaSelect').val();
      let datos1 = $('#form1').serializeArray();
      let datos2 = $('#form2').serializeArray();

       let camposVacios = [];
        [...datos1, ...datos2].forEach(campo => {
          if (!campo.value || campo.value.trim() === '') {
            camposVacios.push(campo.name);
          }
        });
      
      let tablaDatos = [];
      let tablaInvalida = false;

       $('#div3 tbody tr').each(function () {
        let marcado = $(this).find('td:eq(0) input').val();
        let concentracion = $(this).find('td:eq(1) input').val();
        let estratificacion = $(this).find('td:eq(2) input').val();
        let ppm = $(this).find('td:eq(3) input').val();

        if ( !marcado || !concentracion || !estratificacion || !ppm) {
          tablaInvalida = true;
        }

        tablaDatos.push({
          marcado,
          concentracion,
          estratificacion,
          ppm
        });
     
      });
      
      

      let datosCompletos = {
        form1: datos1,
        form2: datos2,
        tabla: tablaDatos,
        normaSelect : normaSelect
      };

     


      let registrosCampos = [];
        $('#CamposRegistros tr').each(function () {
          let fila = $(this);
          let nox = fila.find('input[name="Nox"]').val();
          let co = fila.find('input[name="CO"]').val();
          let o2 = fila.find('input[name="O2"]').val();
          let co2 = fila.find('input[name="CO2"]').val();
          let temp = fila.find('input[name="Temp"]').val();

          if (nox || co || o2 || co2 || temp) {
            registrosCampos.push({ nox, co, o2, co2, temp });
          }
        });

        let registrosCampos2 = [];
        $('#CamposRegistros2 tr').each(function () {
          let fila = $(this);
          let co = fila.find('input[name="CO"]').val();
          let o2 = fila.find('input[name="O2"]').val();
          let co2 = fila.find('input[name="CO2"]').val();
          let temp = fila.find('input[name="Temp"]').val();

          if (co || o2 || co2 || temp) {
            registrosCampos2.push({ co, o2, co2, temp });
          }
        });


        if (camposVacios.length > 0 || tablaInvalida ) {
        Swal.fire({
          icon: 'warning',
          title: 'Campos incompletos',
          text: 'Por favor llena todos los campos antes de guardar.'
        });
        return;
      }

      
      $.ajax({
        url: 'Nom_085/guardar', 
        type: 'POST',
        data: {
          datosCompletos: datosCompletos
        },
        success: function (respuesta) {
          
            Swal.fire({
              icon: 'success',
              title: '¡Éxito!',
              text: 'Guardado correctamente'
            });
        },
        error: function (xhr, status, error) {
          console.error('Error al guardar:', error);
           Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: error
          });
        }
      });
    });
  });

</script>
