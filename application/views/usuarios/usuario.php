<!-- Main Container -->
        <main id="main-container">
			<!-- Page Header -->
			<div class="content bg-gray-lighter">
				<div class="row items-push">
					<div class="col-sm-8">
						<h1 class="page-heading">
							Usuario
						</h1>
					</div>
					<div class="col-sm-4 text-right hidden-md">
						<ol class="breadcrumb push-10-t">
							<li><a class="link-effect" href=" <?= base_url()."index.php/usuarios/viewUsuarios/" ?> ">Usuarios</a></li>
							<li>Usuario</a></li>
						</ol>
					</div>
				</div>
			</div>
			<!-- END Page Header -->

			<!-- Page Content -->
			<div class="content content-narrow">
				<div class="row">
					<div class="col-md-12">
						<div class="block block-bordered">
							<div class="block-header bg-gray-lighter">
	                            <ul class="block-options">
	                            	 <li>
	                                    <button type="button" id="btn_refresh_usuario" data-toggle="popover" title="Usuario" data-placement="left" data-content="Actualizar vista"><i class="si si-refresh"></i></button>
	                                </li>
	                            </ul>
	                            <h3 class="block-title"><?= $title ?></h3>
	                        </div>
							<div class="block-content block-content-narrow">
								<?php $attributes_form = array('class'=>'form-horizontal push-10-t push-10',
														'id'=>'frm_usuario',
														'name'=>'frm_usuario'
								); ?>
								<?=form_open("/articulos/guardar", $attributes_form)?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-material">
												<input class="form-control" type="text" id="us-nombre-completo" name="us-nombre-completo" value="" maxlength="100">
												<label for="art-descripcion">Nombre Completo</label>
											</div> 
										</div>
										<div class="col-md-3">
											<div class="form-material">
												<input class="form-control" type="text" id="us-puesto" name="us-puesto" value="" maxlength="100">
												<label for="art-codcedis">Puesto</label>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-material" id="div_valida_usuario">
												<input class="form-control" type="text" id="us-usuario" name="us-usuario" value="" maxlength="10" onChange="validate_user(this.value);">
												<label for="art-codcedis" id="lab_valida_usuario">Usuario</label>
											</div> 
										</div>
										<div class="col-md-3">
											<div class="form-material">
												<input class="form-control" type="text" id="art-correo" name="art-correo" value="">
												<label for="art-precio1">Correo</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-material">
												<input class="form-control" type="text" id="art-telefono" name="art-telefono" value="">
												<label for="art-precio2">Tel&eacute;fono</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-material">
												<input class="form-control" type="text" id="art-direccion" name="art-direccion" value="" maxlength="200">
												<label for="art-costo">Direcci&oacute;n</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-material">
												<select class="form-control" id="us-sucursal" name="us-sucursal" size="1">



<?php foreach($sucursales as $suc): ?>
	<option value="<?php echo $suc->idTienda ?>"><?php echo $suc->nombreCompleto ?></option>
<?php endforeach;?>

												</select>
												<label for="art-sucursal">Sucursal</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-material">
												<!--  
												<label class="css-input switch switch-info">
													<input type="checkbox" id="us-renueva-pw" name="us-renueva-pw" value="1"><span></span> Cambiar password cada mes
												</label>
												-->
												<div class="form-material">
    												<input class="form-control text-center text-uppercase" type="text" id="inicialesUsuario" name="inicialesUsuario" value="" maxlength="5" onChange="validaIniciales(this);">
    												<label for="art-costo">Iniciales</label>
    											</div>
											</div>
										</div>
										<div class="col-md-3">
										
										</div>
										<div class="col-md-3">
											<div class="form-material">
												<select class="form-control" id="us-usuario-nivel" name="us-usuario-nivel" size="1">
														<option value="1">Super Administrador</option>
														<option value="2">Administrador</option>
														<option value="3">Tecnico</option>
														<option value="4">Almacen</option>
														<option value="5">Supervisor</option>
												</select>
												<label for="art-sucursal">Tipo de Usuario</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center">
											<button class="btn btn-success push-5-r push-1oj0" type="button" id="guardar_usuario"><i class="fa fa-save"></i> Guardar registro</button>
										</div>
									</div>
									<input type="hidden" id="id_usuario" name="id_usuario" value="<?= $id_usuario ?>">
									<input type="hidden" id="url" value="<?= base_url()."index.php/" ?>">
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="display: none;" id="menu_usuario">
					<div class="col-md-12">
						<div class="block">
							<div class="block-header">
								<div class="block-options">
									<code>M&oacute;dulos de Acceso</code>
								</div>
								<h3 class="block-title">Men&uacute;</h3>
							</div>
							<div class="block-content block-content-narrow">
								<div class="row">
									<div class="col-md-3">
										<div class="form-material">
											<select class="form-control" id="us-menu" name="us-menu" size="1">
											</select>
											<label for="art-sucursal">Selecciona el Menu</label>
										</div>
									</div>
									<div class="col-md-9"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="text-center" style="width: 50px;">#</th>
													<th>Menu</th>
												</tr>
											</thead>
											<tbody id="table_menu_usuario"></tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
										<button class="btn btn-success push-5-r push-1oj0" type="button" id="guardar_usuario_menu"><i class="fa fa-save"></i> Asignar Permisos</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Mega Form -->
            <!-- Slide Modal -->
	        <!-- END Slid Modal -->
            <script type="text/javascript">
            	jQuery(document).ready(usuario_functions);
            	setTimeout(function(){
            		$("#btn_refresh_usuario").click();
		        }, 1000);
			</script>
        </main>