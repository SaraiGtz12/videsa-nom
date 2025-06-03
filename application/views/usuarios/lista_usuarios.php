<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Usuarios
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li>Usuarios</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <!-- Page Content -->
                <div class="content">
                    <!-- Full Table -->
                    <div class="block block-bordered">
                        <div class="block-header bg-gray-lighter">
	                            <ul class="block-options">
	                            	 <li>
	                                    <button type="button" id="btn_refresh_lista_us" data-toggle="popover" title="Usuarios" data-placement="left" data-content="Actualizar vista"><i class="si si-refresh"></i></button>
	                                </li>
	                            </ul>
	                            <h3 class="block-title">Lista de Usuarios</h3>
	                        </div>
                        <div class="block-content">
                        	<div class="row">



<div class="col-xs-3">
<div class="form-material">
<select class="form-control" id="lista-tiendas" name="lista-tiendas" size="1">
<option value="1"> LYPSA MOBILE TLALNEPANTLA</option>
<option value="2"> STT Pabellon del Valle</option>
<option value="3"> STT Parque Toreo</option>
<option value="4"> STT Toluca Sendero</option>
<option value="5"> STT Plaza Cuernavaca</option>
<option value="6"> STT Zaragoza</option>
<option value="7"> STT Etram Rosario</option>
<option value="8"> STT Mundo E</option>
<option value="9"> STT Galerias Pachuca</option>
<option value="10"> STT Santa Fe</option>
<option value="11"> STT Tlalnepantla</option>
<option value="12"> STT Parque las Antenas</option>



</select>
<label for="material-text">Sucursales</label>
</div>
</div>


<div class="col-xs-3">
<div class="form-material">
<input class="form-control" type="text" id="criterio-busca-usuario" name="criterio-busca-usuario" placeholder="Ingresa el nombre del usuario">
<label for="material-text">Buscar</label>
</div>
</div>
								<div class="col-xs-6 text-right">
									<div class="form-material">
										<div class="form-control-static">Registros encontrados: <a id="total_usuarios_rows">0</a> </div>
									</div>
								</div>
							 </div>
                            <div class="table-responsive">
                                 <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="hidden-xs" style="width: 40%;">Nombre</th>
                                                <th class="hidden-xs" style="width: 20%;">Tipo</th>
                                                <th class="hidden-xs" style="width: 15%;">Iniciales</th>
                                                <th class="hidden-xs" style="width: 15%;">Usuario</th>
                                                <th class="hidden-xs" style="width: 25%;">Perfil</th>
                                                <th class="hidden-xs" style="width: 10%;">Estado</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lista_usuarios">
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <!-- END Full Table -->
                </div>
                <input type="hidden" id="url" value="<?= base_url()."index.php/" ?>">
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
            <!-- Slide Modal -->
	       	 <div class="modal fade" id="modal-edita-usuario" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="modal-dialog modal-dialog-slideup">
	                <div class="modal-content">
	                    <div class="block block-themed block-transparent remove-margin-b">
	                        <div class="block-header bg-primary-dark">
	                            <ul class="block-options">
	                                <li>
	                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
	                                </li>
	                            </ul>
	                            <h3 class="block-title">Editar usuario</h3>
	                        </div>
	                        <div class="block-content">
	                        	<br>
	                        	<form id="frm-prop-us">
	                        		<div class="row">
										<div class="col-xs-6">
											<div class="form-material">
												<label class="css-input switch switch-info">
													<input type="checkbox" id="us-renueva-pw" name="us-renueva-pw" value="1"><span></span> Reiniciar Password
												</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="form-material">
												<label class="css-input switch switch-info">
													<input type="checkbox" id="us-desactiva-acc" name="us-desactiva-acc" value="1"><span></span> Desactivar Acceso
												</label>
											</div>
										</div>
										<div class="col-xs-6"></div>
		                            </div>
		                            <br>
		                            <div class="row">
		                            	<div class="col-xs-12">
		                            		<button class="btn btn-sm btn-default" type="button" data-dismiss="modal" id="btnBorrarUsuario">Borrar Usuario</button>
		                            	</div>
		                            </div>
		                            <br>
		                            <div class="row">
		                            	<div class="col-xs-12">
		                            		<div class="form-material">
												<input class="form-control" type="text" id="us-observacion" name="us-observacion" value="" maxlength="100">
												<label for="art-costo">Observaci&oacute;n</label>
											</div>
		                            	</div>
		                            </div>
		                            <br>
		                         	<div class="row">
		                         		<table class="table">
	                                        <thead>
	                                            <tr>
	                                                <th>#</th>
	                                                <th>Fecha</th>
	                                                <th>IP</th>
	                                                <th>Navegador</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody id="lista_usuarios_accesos">
	                                        </tbody>
	                                    </table>
		                         	</div>
		                         	<input type="hidden" id="id_usuario" name="id_usuario" value="0">
	                        	</form>
	                        </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cerrar</button>
	                        <button class="btn btn-sm btn-primary" type="button" id="btnGuardarPropUsuario"><i class="fa fa-save"></i> Guardar</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- END Slid Modal -->
            <script type="text/javascript">
            	jQuery(document).ready(lista_usuario_functions);
            	setTimeout(function(){
            		$('#btn_refresh_lista_us').click();
		        }, 1000);
			</script>