 	<!-- Main Container -->
            <main id="main-container">
                <div class="content"> <!-- Page Content -->
                  
<!--******************************CONTENT-->

<h1>INDEX BLANK</h1>
<hr>
                                <div class="row">

                                    <div class="col-md-6 text-right">



                                        <button class="btn btn-rounded btn-info push-5-r push-10" type="button" onclick="javascript:buscaArticulo(this);" accesskey="n" id="btnBuscaArt"><i class="fa fa-search"></i> Buscar</button>
                                        <button class="btn btn-rounded btn-success push-5-r push-10" type="button" id="btnAgregarArt"><i class="fa fa-plus"></i> Agregar</button>
                                        <button class="btn btn-rounded btn-success push-5-r push-10" type="button" id="btnSyncArt" style="display:none;"><i class="fa fa-plus"></i> Sincronizar</button>
                                        <button class="btn btn-rounded btn-danger push-5-r push-10" type="button" id="btnExpImpArtList" data-toggle="tooltip" title="Importar o exportar articulos"> Exportar/Importar</button>
                                    </div>
                                 </div>


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
                                    <tbody id="tbody_articulos">
                                    </tbody>
                                </table>


<!--******************************CONTENT-->
                </div> <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
            <script type="text/javascript">
				
            	$(document).ready(function(){
                
                    document.title = 'Titulo de la Pag'; // titulo de la pag

                    dashboardAdmin();
                    
                });
            
            </script>
