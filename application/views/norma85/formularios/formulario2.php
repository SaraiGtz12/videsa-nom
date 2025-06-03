<div class="container rounded mb-3 p-4 bg-white">
        <div class="text-center mb-3">
            <h3>Captura de Datos de Campo</h3>
        </div>
        <form action="">
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
                    Alacranes Musical
                    <tbody id="CamposRegistros">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">
                                <div class="d-grid">
                                    <input type="submit" value="Agregar" class="btn btn-primary">
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.1.js"></script>
    <script src="<?=asset_url()?>js/norma85/forms/formulario2.js"></script>