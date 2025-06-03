<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?= APP_DESCRIPTION ?></title>

        <meta name="description" content="<?= APP_DESCRIPTION ?>">
        <meta name="author" content="Raul P">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="assets/img/favicons/favicon.png">

        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-192x192.png" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <!-- OneUI CSS framework -->
        <link rel="stylesheet" id="css-main" href="<?=asset_url()?>css/oneui.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        
        <!-- buttonLoader -->
		<link href="<?=asset_url()?>js/plugins/buttonLoader/buttonLoader.css" rel="stylesheet" type="text/css">
		
    </head>
    <body>
 <div> 

        <!-- Login Content -->
        <div class="content overflow-hidden">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">

                            <h3 align="center" class="block-title">Videsa App</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
      
<div align="center">
    

                            <img src="<?=asset_url()?>Videsa.png" style="width: 380px;" alt="">
</div>

                            <!--<p>Bienvenido</p> -->
                            <!-- END Login Title -->

                            <!-- Login Form -->
                            <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation 
                            <form class="js-validation-login form-horizontal push-30-t push-50" action="index.html" method="post"> -->
                            <?php $attributes_form = array('id'=>'verifylogin', 'class'=>'js-validation-login form-horizontal push-30-t push-50');?>
                            <?php echo '<h4 class="text-center" style="color:#ff1a1a">'.validation_errors().'</h4>'; ?>
                            <?=form_open('verifylogin', $attributes_form)?>
                            	<?php if (SHOW_MULTI_CUENTA): ?>
                                	<div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="txtCuenta" autofocus>
                                                <label for="login-username">Cuenta</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary ">
                                            <input class="form-control" type="text" id="login-username" name="login-username">
                                            <label for="login-username">USUARIO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary ">
                                            <input class="form-control" type="password" id="login-password1" name="login-password1">
                                            <label for="login-password">PASSWORD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button id="btnLogin" class="btn btn-primary has-spinner" type="button">INGRESAR AL SISTEMA</button>
                                    </div>
                                </div>
                                <h4 id="lblMsg" style="color:red; display:none! important;" class="text-center">Usuario o Password incorrecto</h4>
                                <input type="hidden" name="idKey" value="<?= API_KEY ?>">
                                <input type="hidden" name="defaultSchema" id="defaultSchema" value="<?= $GLOBALS['DEFAULT_SCHEMA'] ?>">
                            </form>
                            <!-- END Login Form -->
                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
        <!-- END Login Content -->
        
        <!-- Login Footer -->
        <div class="push-10-t text-center animated fadeInUp">
            <small class="text-muted font-w600"><?= APP_NAME ?></small><br>
            <small class="text-muted font-w600"><?= APP_VERSION ?></small>
        </div>
        <!-- END Login Footer -->
        
        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="<?=asset_url()?>js/core/jquery.min.js"></script>
        <script src="<?=asset_url()?>js/core/bootstrap.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.slimscroll.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.scrollLock.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.appear.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.countTo.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.placeholder.min.js"></script>
        <script src="<?=asset_url()?>js/core/js.cookie.min.js"></script>
       	
        <!-- Page JS Plugins -->
        <script src="<?=asset_url()?>js/plugins/jquery-validation/jquery.validate.min.js"></script>
		
        <!-- Page JS Code -->
        <script src="<?=asset_url()?>js/pages/base_pages_login.js"></script>
        
        <!-- buttonLoader -->
		<script src="<?=asset_url()?>js/plugins/buttonLoader/jquery.buttonLoader.min.js"></script>
        
        <input type="hidden" id="url" value="<?= base_url()."index.php/" ?>">
        <input type="hidden" id="baseUrl" value="<?= base_url() ?>">
        
        <script type="text/javascript">
        	
        	if(document.getElementById('txtCuenta') !=null){
        		document.getElementById('txtCuenta').focus();	
            }else{
            	document.getElementById('login-username').focus();
            }
			
			$(document).ready(function(){
				
				$('#txtCuenta').keypress(function(e) {
					var valu = this.value;
					var cuentaEnco = false;
					if(e.which == 13) {
						$.getJSON($('#baseUrl').val() + '/account.js', function(data) {
    						  for(var i in data) {
    							  let d = data[i];
    							  if(d != null){
    								  if(valu == d.cuenta) {
    									$('#appDescription').html(d.descripcion);
    									$('#defaultSchema').val(d.database);
    									cuentaEnco = true;
    								  }
    							  }
    					      }
    						  var edo = false;
    						  if(cuentaEnco === false){
    							alert('No se encontr� la cuenta del establecimiento, favor de reportarlo');
    							edo = true;
    						  }else{
    							  $('#login-username').focus();
            			      }
    						  $('#btnLogin').prop('disabled', edo);
    						  $('#login-username').prop('disabled', edo);
    						  $('#login-password1').prop('disabled', edo);  
						});
					}
				});
				
				$('#btnLogin').click(function(e) {
					let btn = $(this);
					$.ajax({
						type: 'POST',
						url: $('#url').val() + 'verifyloginrest/veryfyUser',
						beforeSend: function(){
							$(btn).buttonLoader('start');
						},
						complete: function(r){
							console.log('ressCo ', r);
							let res = r.responseJSON;
							if(!res.status){
								$(btn).buttonLoader('stop');
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
					    	$('#lblMsg').show();
					    },
						data: $('#verifylogin').serialize(),
					}).done(function(r){
						try{

							if(r.status){		
								btn.prop('disabled', true);
								window.location.replace(r.url);
							}else{
								$('#lblMsg').show();
							}
							
						}catch(e){
							alert('Error interno, favor de reportarlo al administrador del sistema');
							console.log(e);
						}
					});
				});
				$('#login-username').keypress(function(e) {
					if(e.which==13) {
						$('#login-password1').focus();
					}
				});
				$('#login-password1').keypress(function(e) {
					if(e.which==13) {
						$('#btnLogin').click();
					}
				});
			});
        </script>
        
    </body>
</html>