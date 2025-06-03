 <!-- Footer -->
 			<?php
 				# extracci�n de usuario
 				$data_session = $this->session->userdata('logged_in');
 				$nombre_completo = $data_session['nombre_completo'];
				$tienda = strtoupper($data_session['tienda']);
				$idTienda = $data_session['id_tienda'];
				$tiendas = $data_session['listaTiendas'];
				$idUsuario =  $data_session['id_usuario'];
				$usuarioNivel = $data_session['id_usuario_nivel'];
				$idKey = $data_session['idKey'];
 			?>
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-black-lighter clearfix">
                <div class="pull-right">
                    <h5>Usuario : <a href="#"><?= $nombre_completo .' | '. $tienda ?></a></h5>
                </div>
                <div class="pull-left">  
                    <a class="font-w600" href="#" target="_blank">Videsa </a> &copy; <?= date('d/m/y') ?>
                </div>
            </footer>
            <!-- END Footer -->
            <!-- Modal -->
            
            <div class="modal fade" id="modal-datos-usuario" role="dialog" aria-hidden="true">
	            <div class="modal-dialog modal-dialog-slideup">
	                <div class="modal-content">
	                    <div class="block">
	                        <div class="block-content">
								<div class="row">
									<div class="col-md-12">
										<div class="form-material">
    										<input class="form-control" type="text" id="txtUsurioNombreCompe" value="" maxlength="40">
    										<label for="art-descripcion">Nombre Completo</label>
    									</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-material">
    										<input class="form-control" type="text" id="txtUsuario" value="" maxlength="40" disabled="disabled">
    										<label for="art-descripcion">Usuario</label>
    									</div> 
									</div>
									<div class="col-md-6">
										<div class="form-material">
    										<input class="form-control" type="text" id="txtUsuarioCorreo" value="" maxlength="40">
    										<label for="art-descripcion">Correo</label>
    									</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-material">
											<select class="form-control" id="idUsuarioNivel" name="idUsuarioNivel" size="1" disabled="disabled">
													<option value="1">Super Administrador</option>
													<option value="2">Administrador</option>
													<option value="3">Usuario</option>
													<option value="4">Cajero</option>
													<option value="5">Vendedor</option>
											</select>
											<label for="art-sucursal">Tipo de Usuario</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-material">
											<select class="form-control" id="idTienda" name="us-sucursal" size="1" disabled="disabled">
													<option value="1">Corregidora</option>
													<option value="2">Roldan</option>
													<option value="3">CEDIS</option>
											</select>
											<label for="art-sucursal">Sucursal</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="btn " type="button" id="changePass" value="Cambiar Password">
									</div>
									<div class="col-md-6"></div>
								</div>
								<br>
								<div class="row" id="passActual" style="display: none;">
									<div class="col-md-6">
										<div class="form-material">
    										<input class="form-control text-center" type="text" id="txtPasswordAc" value="">
    										<label for="art-descripcion">Password actual</label>
    									</div>
									</div>
									<div class="col-md-6"></div>
								</div>
								<div id="txtsPassword" style="display: none;">
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-material">
        										<input class="form-control text-center" type="text" id="txtPasswordNue1" value="">
        										<label for="art-descripcion">Nueva password</label>
        									</div>
    									</div>
    									<div class="col-md-6"></div>
    								</div>
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-material">
        										<input class="form-control text-center" type="text" id="txtPasswordNue2" value="">
        										<label for="art-descripcion">Repite tu password</label>
        									</div>
    									</div>
    									<div class="col-md-6"></div>
    								</div>
    							</div>
	                        </div>
	                    </div>
	                    <div class="modal-footer">
	                    	<button class="btn btn-sm btn-success" type="button" data-dismiss="modal" id="btnSaveUser">Actualizar</button>
	                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cancelar</button>
	                    </div>
	                </div>
	            </div>
	        </div>
            
            <div class="modal fade" id="modalCambiaTienda" role="dialog" aria-hidden="true">
	            <div class="modal-dialog modal-dialog-slideup">
	                <div class="modal-content">
	                    <div class="block">
	                        <div class="block-content">
	                        	<label>Cambio de Tienda</label>
								<div class="row">
									<?php 
										$txtOut = '';
										foreach ($tiendas as $tienda){
											// function para pintado de tiendas para cambio de usuario ******** PENDIENTE
											/*
											$txtOut .= '<div class="col-md-4">';
												$txtOut .=
												
											$txtOut .= '<div/">'
											*/
										}
									?>
									 <div class="col-md-4">
		                                <a class="block block-link-hover3 text-center" href="javascript:cambioTiendaUsuario(1)" id="tieCajCorre">
		                                    <div class="block-content block-content-full">
		                                        <i class="si si-basket fa-4x text-primary-darker"></i>
		                                        <div class="font-w600 push-15-t">-------</div>
		                                    </div>
		                                </a>
		                            </div>
		                            <div class="col-md-4">
		                                <a class="block block-link-hover3 text-center" href="javascript:cambioTiendaUsuario(2)" id="tieCajRol">
		                                    <div class="block-content block-content-full">
		                                        <i class="si si-basket fa-4x text-danger"></i>
		                                        <div class="font-w600 push-15-t">---------</div>
		                                    </div>
		                                </a>
		                            </div>
		                            <div class="col-md-4">
		                                <a class="block block-link-hover3 text-center" href="javascript:cambioTiendaUsuario(3)" id="tieCajCEDIS">
		                                    <div class="block-content block-content-full">
		                                        <i class="si si-basket-loaded fa-4x text-warning"></i>
		                                        <div class="font-w600 push-15-t">----------</div>
		                                    </div>
		                                </a>
		                            </div>
								</div>
	                        </div>
	                    </div>
	                    <input type="hidden" id="idOrdenC" value="0">
	                    <div class="modal-footer">
	                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cancelar</button>
	                    </div>
	                </div>
	            </div>
	        </div>
            <!-- End Modal -->
            <!-- global url -->
            <input type="hidden" id="url" value="<?= base_url()."index.php/" ?>">
            <input type="hidden" id="base_url" value="<?= base_url() ?>">
            <input type="hidden" id="idTienda" name="idTienda" value="<?= $idTienda ?>">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $idUsuario ?>">
            <input type="hidden" id="usuarioNivel" value="<?= $usuarioNivel ?>">
            <input type="hidden" id="idKey" value="<?= $idKey ?>">
            <!--  -->
        </div>


		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>

        <!-- END Page Container --> 
        <!-- Page Plugins -->
        <script src="<?=asset_url()?>js/plugins/slick/slick.min.js"></script>
        <script src="<?=asset_url()?>js/plugins/chartjs/Chart.min.js"></script>
        <!-- Page JS Code 
        <script src="<?=asset_url()?>js/pages/base_pages_dashboard.js"></script>
        -->
        <!-- Page JS Plugins -->
        <script src="<?=asset_url()?>js/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- Page JS Code 
        <script src="<?=asset_url()?>js/pages/base_tables_datatables.js"></script>
        -->
        <!-- Page Tags Code  -->
        <script src="<?=asset_url()?>js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
        <!-- Autocomplete -->
        <script src="<?=asset_url()?>js/plugins/autocomplete/jquery-ui-1.10.4.custom.min.js"></script>
        <!-- Select2 -->
        <script src="<?=asset_url()?>js/plugins/select2/select2.full.min.js"></script>
        <!-- editable -->
        <script src="<?=asset_url()?>js/plugins/editable/js/bootstrap-editable.min.js"></script>
        <!-- sweetalert -->
        <script src="<?=asset_url()?>js/plugins/sweetalert/sweetalert.min.js"></script>
        <!-- datepicker -->
        <script src="<?=asset_url()?>js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <!-- notify -->
        <script src="<?=asset_url()?>js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
        <!-- html5SQL -->
        <script src="<?=asset_url()?>js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
        <!-- Fancybox -->
		<script src="<?=asset_url()?>js/plugins/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <!-- Currency -->
		<script src="<?=asset_url()?>js/plugins/currency/currency.min.js"></script>
		<!-- Moment -->
		<script src="<?=asset_url()?>js/plugins/moment/moment.min.js"></script>
		<script src="<?=asset_url()?>js/plugins/moment/moment-with-locales.min.js"></script>
		<!-- Dateformat -->
		<script src="<?=asset_url()?>js/plugins/dateFormat/jquery-dateformat.min.js"></script>
		<!-- excelexportjs -->
		<script src="<?=asset_url()?>js/plugins/excelexportjs/excelexportjs.js"></script>
		<!-- buttonLoader -->
		<script src="<?=asset_url()?>js/plugins/buttonLoader/jquery.buttonLoader.min.js"></script>
		
		<!-- bootgrid-master 
		<script src="<?=asset_url()?>js/plugins/jquery-bootgrid-master/jquery.bootgrid.min.js"></script>
        <script src="<?=asset_url()?>js/plugins/jquery-bootgrid-master/jquery.bootgrid.fa.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>



<!-- XXXCHOSEXXXXXXXXXXXXXXXXXXXXX -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.proto.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>

<!--XXXCHOSEXXXXXXXXXXXXXXXXXXXXXXX -->




        <!-- Page Plugins -->
        <script src="<?=asset_url()?>js/plugins/slick/slick.min.js"></script>
        
        <!-- Page Plugins -->
        <script src="<?=asset_url()?>js/plugins/html5sql/html5sql.js"></script>
      

<!--ADMINLTE-->


<script>
   jQuery(document).ready(function($)   {

$(".refacciones_chosen").chosen({

    width: "100%"
  });
}); 
</script>






        <script type="text/javascript">
        	var idTienda = <?= $idTienda ?>;
	        $(function() {
				$('#btnSaveUser').click(function(){

					let r = confirm('�Son correctos los datos?');
					if(r){
		
						var path = $('#url').val();
		        		var block = jQuery(this).parents('.block');
		        		var $data = jQuery(this);
		      
		        		$.ajax({
		        			type: 'POST',
		        			url: path + 'usuariosrest/resetPassword',
		        			beforeSend: function() {
		        				block_class(true, block);
		        			},
		        			complete: function() {
		        				block_class(false, block);
		        			},
		        		    error: function(XMLHttpRequest, textStatus, errorThrown) {
		        		    	swal({
		        	    			  type: 'error',
		        	    			  title: 'Error',
		        	    			  text: 'Error de validaci�n de datos, favor de reportarlo'
		        	          	});
		        		    }, 
		        			data: {
		        				idKey: $('#idKey').val(),
		        				idUsuario: $('#idUsuario').val(),
		        				password: pass2
		        			},
		        		}).done(function(a){
		        			try{
			        			let i = a.status;
								if(i){
									swal({
			        	    			  type: 'success',
			        	    			  title: 'Cambio de password',
			        	    			  text: 'El password se cambio correctamente'
			        	          	}, function (e){
			        	          		$('#modal-datos-usuario').modal('toggle');
					        	    });
								}else{
									swal({
			        	    			  type: 'error',
			        	    			  title: 'Error',
			        	    			  text: 'Error al cambiar el password, favor de reportarlo'
			        	          	});
								}
		        			}catch(e){
		        				swal({
		        	    			  type: 'error',
		        	    			  title: 'Error al descomponer el objeto, favor de reportarlo'
		        	          	});
		        				console.log(e);
		        			}
		        		});

					} // end if	

					
				});
		        
				$('#changePass').click(function() {
					$('#passActual').show();
				});
				$('#txtPasswordAc').keypress(function(e){
					if(e.which==13) {

						var path = $('#url').val();
		        		var block = jQuery(this).parents('.block');
		        		var $data = jQuery(this);
		      
		        		$.ajax({
		        			type: 'POST',
		        			url: path + 'usuariosrest/validatePassword',
		        			beforeSend: function() {
		        				block_class(true, block);
		        			},
		        			complete: function() {
		        				block_class(false, block);
		        			},
		        		    error: function(XMLHttpRequest, textStatus, errorThrown) {
		        		    	swal({
		        	    			  type: 'error',
		        	    			  title: 'Error',
		        	    			  text: 'Error de validaci�n de datos, favor de reportarlo'
		        	          	});
		        		    }, 
		        			data: {
		        				idKey: $('#idKey').val(),
		        				idUsuario: $('#idUsuario').val(),
		        				password: $('#txtPasswordAc').val()
		        			},
		        		}).done(function(a){
		        			try{
			        			let i = a.item;
								if(i != null){
									
									$('#passActual').hide();
									$('#txtPasswordAc').val('');

									$('#txtsPassword').show();
									$('#txtPasswordNue1').val('');
									$('#txtPasswordNue2').val('');

									$('#txtPasswordNue1').focus();
								}else{
									alert('Las contrase�a es incorrecta');
									$('#txtPasswordAc').focus();
								}
		        			}catch(e){
		        				swal({
		        	    			  type: 'error',
		        	    			  title: 'Error al descomponer el objeto, favor de reportarlo'
		        	          	});
		        				console.log(e);
		        			}
		        		});
					}
				});

				$('#txtPasswordNue1').keypress(function(e) {
					if(e.which==13) {
						$('#txtPasswordNue2').focus();
					}
				});

				$('#txtPasswordNue2').keypress(function(e) {
					if(e.which==13) {
						let pass1 = $('#txtPasswordNue1').val();
						let pass2 = $('#txtPasswordNue2').val();
						if(pass1 != pass2) {
							alert('Las contrase�as escritas son incorrectas');
						}else{

							let r = confirm('�Son correctos los datos?');
							if(r){
				
								var path = $('#url').val();
				        		var block = jQuery(this).parents('.block');
				        		var $data = jQuery(this);
				      
				        		$.ajax({
				        			type: 'POST',
				        			url: path + 'usuariosrest/resetPassword',
				        			beforeSend: function() {
				        				block_class(true, block);
				        			},
				        			complete: function() {
				        				block_class(false, block);
				        			},
				        		    error: function(XMLHttpRequest, textStatus, errorThrown) {
				        		    	swal({
				        	    			  type: 'error',
				        	    			  title: 'Error',
				        	    			  text: 'Error de validaci�n de datos, favor de reportarlo'
				        	          	});
				        		    }, 
				        			data: {
				        				idKey: $('#idKey').val(),
				        				idUsuario: $('#idUsuario').val(),
				        				password: pass2
				        			},
				        		}).done(function(a){
				        			try{
					        			let i = a.status;
										if(i){
											swal({
					        	    			  type: 'success',
					        	    			  title: 'Cambio de password',
					        	    			  text: 'El password se cambio correctamente'
					        	          	}, function (e){
					        	          		$('#modal-datos-usuario').modal('toggle');
							        	    });
										}else{
											swal({
					        	    			  type: 'error',
					        	    			  title: 'Error',
					        	    			  text: 'Error al cambiar el password, favor de reportarlo'
					        	          	});
										}
				        			}catch(e){
				        				swal({
				        	    			  type: 'error',
				        	    			  title: 'Error al descomponer el objeto, favor de reportarlo'
				        	          	});
				        				console.log(e);
				        			}
				        		});

							} // end if	
						}
					}
				});
				
	        	$('#btnShowUser').click(function() {

	        		var path = $('#url').val();
	        		var block = jQuery(this).parents('.block');
	        		var $data = jQuery(this);
	      
	        		$.ajax({
	        			type: 'POST',
	        			url: path + 'usuariosrest/getUserData',
	        			beforeSend: function() {
	        				block_class(true, block);
	        			},
	        			complete: function() {
	        				block_class(false, block);
	        			},
	        		    error: function(XMLHttpRequest, textStatus, errorThrown) {
	        		    	swal({
	        	    			  type: 'error',
	        	    			  title: 'Error',
	        	    			  text: 'Error de validaci�n de datos, favor de reportarlo'
	        	          	});
	        		    }, 
	        			data: {
	        				idKey: $('#idKey').val(),
	        				idUsuario: $('#idUsuario').val()
	        			},
	        		}).done(function(ansawer){
	        			try{
		        			
	        				var nItera = 1;
	        				var j = ansawer;
	        				var i = j.item;

	        				$('#modal-datos-usuario').modal('toggle');

							$('#txtUsurioNombreCompe').val(i.nombre_completo);	
							$('#txtUsuario').val(i.usuario);
							$('#txtUsuarioCorreo').val(i.correo);
							$('#txtUsuarioDireccion').val(i.direccion);
							$('#idUsuarioNivel').val(i.id_usuario_nivel);
							$('#idTienda').val(i.id_tienda);
							
	        			}catch(e){
	        				swal({
	        	    			  type: 'error',
	        	    			  title: 'Error al descomponer el objeto, favor de reportarlo'
	        	          	});
	        				console.log(e);
	        			}
	        		});
					
		        });
		        
	        	$('#lblCambiaTienda').click(function(){
					$('#modalCambiaTienda').modal('toggle');
					switch(idTienda){
						case 1:
							resetColorsCajaTienda();
							$('#tieCajCorre').css('background-color', '#99ff99');
							break;
						case 2:
							resetColorsCajaTienda();
							$('#tieCajRol').css('background-color', '#99ff99');
							break;
						case 3:
							resetColorsCajaTienda();
							$('#tieCajCEDIS').css('background-color', '#99ff99');
							break;
					}
		       	});
				$('#tieCajCorre').click(function(){
					resetColorsCajaTienda();
					$(this).css('background-color', '#99ff99');
					saveUserTienda(1);
				});
				$('#tieCajRol').click(function(){
					resetColorsCajaTienda();
					$(this).css('background-color', '#99ff99');
					saveUserTienda(2);
				});
				$('#tieCajCEDIS').click(function(){
					resetColorsCajaTienda();
					$(this).css('background-color', '#99ff99');
					saveUserTienda(3);
				});
		       	function resetColorsCajaTienda(){
		       		$('#tieCajCorre').css('background-color', 'white');
		       		$('#tieCajRol').css('background-color', 'white');
		       		$('#tieCajCEDIS').css('background-color', 'white');
		       	}
		       	function saveUserTienda(idTienda){
				
		       		//var block = jQuery(this).parents('.block');
		       		var baseUrl = '<?= base_url().'index.php/' ?>';
		       		
		       		$.ajax({
		       			type: 'POST',
		       			url: baseUrl + 'usuarios/setIdTienda',
		       			beforeSend: function(){
		       				//block_class(true, block);
		       			},
		       			complete: function(){
		       				//block_class(false, block);
		       			},
		       			data: {idTienda:idTienda},
		       		}).done(function(ansawer){
		       			try{
		       				var jsonResponse = JSON.parse(ansawer);
		       				if(jsonResponse.msg=='success'){
								alert('El cambio de tienda se efectu� correctamente, inicia sesi�n nuevamente para ingresar');
								$(location).attr('href', baseUrl);
		       				}
		       			}catch(e){
		       				alert('Error, favor de reportarlo al administrador');
		       				console.log(e);
		       			}
		       		});
		       	}
	        });
        </script>







    </body>
</html>