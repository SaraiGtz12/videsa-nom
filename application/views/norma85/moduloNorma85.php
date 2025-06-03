<h2 class="mb-4">Selecciona una norma</h2>

<main id="main-container">
    <div class="content">
        <h1>Norma 085</h1>
        <div class="row mb-4">
            <div class="col-md-6">
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

        <!-- Resultados -->
        <div class="row">
            <div class="col-md-12">
                <h3>Resultados</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table_articulos" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th class="text-center">Item</th>
                                <th class="text-center">Medida</th>
                                <th class="text-center">Precio1</th>
                                <th class="text-center">Precio2</th>
                                <th class="text-center">Estatus</th>
                                <th class="text-center">Existencia</th>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


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
</script>

