<h2 class="mb-4">Selecciona una norma</h2>

<main id="main-container">
    <div class="content">
        <h1>Norma 085</h1>
        <div class="row mb-4">
            <div class="col-md-12">
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

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0" style="flex: 1;">Resultados</h3>
                <button type="button" class="btn btn-primary" id="btnAgregar">
                    <i class="fa fa-plus"></i> Agregar
                </button>
                </div>
            </div>
        </div>




        <div class="row mb-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table_articulos" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>CO. (ppmv)</th>
                                <th class="text-center">O2%</th>
                                <th class="text-center">CO2%</th>
                                <th class="text-center">TEMP. en el conducto</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_articulos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- formulario para agregar registro -->


<!-- Modal para agregar registro -->
<div class="modal" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAgregar">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAgregarLabel">Agregar nuevo registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="inputCO" class="form-label">CO (ppmv)</label>
            <input type="number" step="any" class="form-control" id="inputCO" required>
          </div>
          <div class="mb-3">
            <label for="inputO2" class="form-label">O2 (%)</label>
            <input type="number" step="any" class="form-control" id="inputO2" required>
          </div>
          <div class="mb-3">
            <label for="inputCO2" class="form-label">CO2 (%)</label>
            <input type="number" step="any" class="form-control" id="inputCO2" required>
          </div>
          <div class="mb-3">
            <label for="inputTEMP" class="form-label">TEMP. en el conducto (°C)</label>
            <input type="number" step="any" class="form-control" id="inputTEMP" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>






<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        document.title = 'Título de la página';
        $('#normaSelect').select2({
            placeholder: "Selecciona una opción",
            width: '100%'
        });
        $('#table_articulos').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-MX.json'
            }
        });

    });


    document.addEventListener('DOMContentLoaded', function () {
        const btnAgregar = document.getElementById('btnAgregar');
        const modalAgregar = new bootstrap.Modal(document.getElementById('modalAgregar'));

        btnAgregar.addEventListener('click', () => {
        modalAgregar.show();
        });

        document.getElementById('formAgregar').addEventListener('submit', function(e) {
        e.preventDefault();
        const CO = document.getElementById('inputCO').value;
        const O2 = document.getElementById('inputO2').value;
        const CO2 = document.getElementById('inputCO2').value;
        const TEMP = document.getElementById('inputTEMP').value;

        console.log({ CO, O2, CO2, TEMP });
        // modalAgregar.hide();
        // this.reset();
        });
    });
</script>

