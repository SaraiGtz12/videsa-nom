<h2 class="mb-4">Selecciona una norma</h2>
<main id="main-container">
    <div class="content">
        <h1>Norma 085</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="normaSelect" class="form-label">Norma</label>
                        <select  class="form-select w-50">
                            <option value="">-- Elige --</option>
                            <option value="085MG">085MG</option>
                            <option value="085G">085G</option>
                            <option value="085L">085L</option>
                            <option value="085ML">085ML</option>
                        </select>
                </div>
                    <hr>

                    <h3 class="mt-4">Resultados</h3>
                    <table class="table dataTable-full display nowrap" id="table_articulos">
                        <thead>
                            <tr>
                                <th style="width: 8%;"><label>C&oacute;digo</label></th>
                                <th style="width: 30%;"><label>Descripci&oacute;n</label></th>
                                <th class="text-center" style="width: 7%;"><label>Item</label></th>
                                <th class="text-center" style="width: 7%;"><label>Medida</label></th>
                                <th class="text-center" style="width: 7%;"><label>Precio1</label></th>
                                <th class="text-center" style="width: 7%;"><label>Precio2</label></th>
                                <th class="text-center" style="width: 7%;"><label>Estatus</label></th>
                                <th class="text-center" style="width: 7%;"><label>Existencia</label></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_articulos"></tbody>
                    </table>
            </div>
    </div>
</main>
 
 <script type="text/javascript">
    $(document).ready(function(){
        document.title = 'Titulo de la Pag'; 
        dashboardAdmin();              
    });
</script>
