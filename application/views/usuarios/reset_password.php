<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Reiniciar contrase&ntilde;a</title>

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="assets/img/favicons/favicon.png">

        <link rel="icon" type="image/png" href="<?=asset_url()?>img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="<?=asset_url()?>img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?=asset_url()?>img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?=asset_url()?>img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="<?=asset_url()?>img/favicons/favicon-192x192.png" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="<?=asset_url()?>img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?=asset_url()?>img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?=asset_url()?>img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?=asset_url()?>img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?=asset_url()?>img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?=asset_url()?>img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?=asset_url()?>img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?=asset_url()?>img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=asset_url()?>img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <!-- OneUI CSS framework -->
        <link rel="stylesheet" id="css-main" href="<?=asset_url()?>css/oneui.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Register Content -->
        <div class="content overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <!-- Register Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-success">
                            <h3 class="block-title">Registrar nuevo password</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Register Title -->
                            <h1 class="h2 font-w600 push-30-t push-5">LYP S.A. DE C.V.</h1>
                            <p>Ingresa los datos solicitados.</p>
                            <!-- END Register Title -->
                            <?php $attributes_form = array('class'=>'js-validation-register form-horizontal push-50-t push-50',
													'id'=>'frm_reset_pw',
													'name'=>'frm_reset_pw'
							); ?>
							<?=form_open("/resetpassword/reset", $attributes_form)?>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-success">
                                            <input class="form-control" type="text" id="register-username" name="register-username" value="<?= $nombre_completo ?>" placeholder="Ingresa el nombre de Usuario" disabled>
                                            <label for="register-username">Usuario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-success">
                                            <input class="form-control" type="password" id="register-password" name="register-password" placeholder="Ingresa tu nuevo password">
                                            <label for="register-password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-success">
                                            <input class="form-control" type="password" id="register-password2" name="register-password2" placeholder="Confirma el password">
                                            <label for="register-password2">Confirma Password</label>
                                        </div>
                                    </div>
                                </div>
                                <?= $msg ?>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <button class="btn btn-block btn-success" type="submit"><i class="fa fa-plus pull-right"></i> Cambiar Contraseña</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                            </form>
                            <!-- END Register Form -->
                        </div>
                    </div>
                    <!-- END Register Block -->
                </div>
            </div>
        </div>
        <!-- END Register Content -->

        <!-- Register Footer -->
        <div class="push-10-t text-center animated fadeInUp">
            <small class="text-muted font-w600">LYP</small>
        </div>
        <script src="<?=asset_url()?>js/core/jquery.min.js"></script>
        <script src="<?=asset_url()?>js/core/bootstrap.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.slimscroll.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.scrollLock.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.appear.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.countTo.min.js"></script>
        <script src="<?=asset_url()?>js/core/jquery.placeholder.min.js"></script>
        <script src="<?=asset_url()?>js/core/js.cookie.min.js"></script>
        <script src="<?=asset_url()?>js/app.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?=asset_url()?>js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?=asset_url()?>js/pages/base_pages_register.js"></script>
        
        <script type="text/javascript">
			document.getElementById('register-password').focus();
        </script>
    </body>
