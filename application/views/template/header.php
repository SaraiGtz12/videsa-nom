<?php
    $data_session = $this->session->userdata('logged_in');
    $version = $data_session['version'];
    $tienda = strtoupper($data_session['tienda']);
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus">
<!--<![endif]-->
<head>
<title><?= $tienda ?></title>
<!-- Icons -->
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon"
	href="<?=asset_url()?>img/logotipo.jpeg">
<!-- Stylesheets -->
<!-- Web fonts 
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
		-->
<link rel="stylesheet" href="<?=asset_url()?>css/font.css">
<!-- Page JS datatable -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/datatables/buttons.dataTables.min.css">
<!-- AutoComplete -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/autocomplete/jquery-ui-1.10.4.custom.min.css">
<!-- Select2 -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/select2/select2.min.css">
<!-- tags -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
<!-- OneUI CSS framework -->
<link rel="stylesheet" id="css-main"
	href="<?=asset_url()?>css/oneui.css">
<!-- editable -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/editable/css/bootstrap-editable.css">
<!-- sweetalert -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/sweetalert/sweetalert.css">
<!-- datepicker -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<!-- slick -->
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/slick/slick.min.css">
<link rel="stylesheet"
	href="<?=asset_url()?>js/plugins/slick/slick-theme.min.css">

<!-- FancyBox -->
<link
	href="<?=asset_url()?>js/plugins/fancybox/jquery.fancybox.css?v=2.1.5"
	rel="stylesheet">

<!-- bootgrid-master 
        <link href="<?=asset_url()?>js/plugins/jquery-bootgrid-master/jquery.bootgrid.css" rel="stylesheet" /> -->

<!-- qz-print -->
<script
	src="<?=asset_url()?>js/plugins/qz-print-2/dependencies/rsvp-3.1.0.min.js"></script>
<script
	src="<?=asset_url()?>js/plugins/qz-print-2/dependencies/sha-256.min.js"></script>
<script src="<?=asset_url()?>js/plugins/qz-print-2/qz-tray.js"></script>

<!-- buttonLoader -->
<link href="<?=asset_url()?>js/plugins/buttonLoader/buttonLoader.css" rel="stylesheet" type="text/css">





<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
<script src="<?=asset_url()?>js/core/jquery.min.js"></script>
<script src="<?=asset_url()?>js/core/bootstrap.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.slimscroll.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.scrollLock.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.appear.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.countTo.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.placeholder.min.js"></script>
<script src="<?=asset_url()?>js/core/js.cookie.min.js"></script>
<script src="<?=asset_url()?>js/core/js.cookie.min.js"></script>
<script src="<?=asset_url()?>js/core/jquery.hotkeys.js"></script>
<script src="<?=asset_url()?>js/app.js"></script>
<script>const base_url = "<?= base_url('index.php/'); ?>";</script>
<!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
<!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
<!-- END Stylesheets -->





</head>
<body>
	<!-- Page Container -->
	<!--
            Available Classes:
            'sidebar-l'                  Left Sidebar and right Side Overlay
            'sidebar-r'                  Right Sidebar and left Side Overlay
            'sidebar-mini'               Mini hoverable Sidebar (> 991px)
            'sidebar-o'                  Visible Sidebar by default (> 991px)
            'sidebar-o-xs'               Visible Sidebar by default (< 992px)
            'side-overlay-hover'         Hoverable Side Overlay (> 991px)
            'side-overlay-o'             Visible Side Overlay by default (> 991px)
            'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)
            'header-navbar-fixed'        Enables fixed header
        -->
	<div id="page-container"
		class="sidebar-l sidebar-mini sidebar-o side-scroll header-navbar-fixed">
		<!-- Side Overlay-->
		<aside id="side-overlay">
			<!-- Side Overlay Scroll Container -->
			<div id="side-overlay-scroll">
				<!-- Side Header -->
				<div class="side-header side-content">
					<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
					<button class="btn btn-default pull-right" type="button"
						data-toggle="layout" data-action="side_overlay_close">
						<i class="fa fa-times"></i>
					</button>
					<span> <img class="img-avatar img-avatar32"
						src="<?=asset_url()?>img/logotipo.jpeg" alt=""> <span
						class="font-w600 push-10-l">Administrador</span>
					</span>
				</div>
				<!-- END Side Header -->
				<!-- Side Content -->
				<div class="side-content remove-padding-t">
					<!-- Notifications -->
	





					<!-- Quick Settings -->
					<div class="block pull-r-l"></div>
					<!-- END Quick Settings -->
				</div>
				<!-- END Side Content -->
			</div>
			<!-- END Side Overlay Scroll Container -->
		</aside>
		<!-- END Side Overlay -->

		<!-- Sidebar -->
		<nav id="sidebar">
			<!-- Sidebar Scroll Container -->
			<div id="sidebar-scroll">
				<!-- Sidebar Content -->
				<!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
				<div class="sidebar-content">
					<!-- Side Header -->
					<div class="side-header side-content bg-white-op">
						<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
						<button
							class="btn btn-link text-gray pull-right hidden-md hidden-lg"
							type="button" data-toggle="layout" data-action="sidebar_close">
							<i class="fa fa-times"></i>
						</button>
						<!-- Themes functionality initialized in App() -> uiHandleTheme() -->
						<div class="btn-group pull-right"></div>
						<a class="h5 text-white" href="#"> <i
							class="fa fa-wifi text-primary"></i> <span
							class="h4 font-w600 sidebar-mini-hide">Videsa</span>
						</a>
					</div>
					<!-- END Side Header -->

					<!-- Side Content -->
					<div class="side-content">
						<ul class="nav-main">
							<li>
								<a href='<?= base_url() ?>index.php/dashboard'>
									<i class='si si-grid'></i><span class='sidebar-mini-hide'>Inicio</span>
								</a>
							</li>







<li>
<a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-social-dropbox"></i><span class="sidebar-mini-hide">Muestreo</span></a>
<?php foreach ($menus as $menu): ?>
<?php if ($menu['id_menu'] == 1): ?>
<ul>
<li>
<div class="row">
<div class="col-sm-8">
<a href="<?= base_url() ?>index.php<?=  $menu['url'] ?>"><?= $menu['menu'] ?></a>	
</div>
<div class="col-sm-4 text-right">
<?php if ($menu['urlAddItem'] != NULL): ?>
<a href="<?= base_url() ?>index.php<?=  $menu['urlAddItem'] ?>">

</a>
<?php endif; ?>
</div>
</div>
</li>
</ul>
<?php endif; ?>
<?php endforeach; ?>
</li>










<hr>






<li>
<a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Configuraci&oacute;n</span></a>
<?php foreach ($menus as $menu): ?>
<?php if ($menu['id_menu'] == 10): ?>
<ul>
<li>
<div class="row">
<div class="col-sm-8">
<a href="<?= base_url() ?>index.php<?=  $menu['url'] ?>"><?= $menu['menu'] ?></a>	
</div>
<div class="col-sm-4 text-right">
<?php if ($menu['urlAddItem'] != NULL): ?>
<a href="<?= base_url() ?>index.php<?=  $menu['urlAddItem'] ?>">
<i class="fa fa-plus" data-original-title="Nuevo" title="Nuevo"></i>
</a>
<?php endif; ?>
</div>
</div>
</li>






                                        </ul>
                                    <?php endif; ?>
								<?php endforeach; ?>
							</li>
                        </ul>
					</div>
					<!-- END Side Content -->
				</div>
				<!-- Sidebar Content -->
			</div>
			<!-- END Sidebar Scroll Container -->
		</nav>
		<!-- END Sidebar -->

		<!-- Header -->
		<header id="header-navbar" class="content-mini content-mini-full">
			<!-- Header Navigation Right -->
			<ul class="nav-header pull-right">
				<li>
					<div class="btn-group">
						<button class="btn btn-default btn-image dropdown-toggle"
							data-toggle="dropdown" type="button">
                            	<?php
                            /*
                             * cambiando color de ico segun el rol del usuario
                             * Sol por ivan 05/04/2017
                             */
                            $idUsuarioNivel = $data_session['id_usuario_nivel'];
                            $urlPath;
                            if ($idUsuarioNivel == 1) {
                                $urlPath = asset_url() . 'img/Videsa.png';
                            } else if ($idUsuarioNivel == 2) {
                                $urlPath = asset_url() . 'img/Videsa.png';
                            } else if ($idUsuarioNivel >= 3) {
                                $urlPath = asset_url() . 'img/Videsa.png';
                            }
                            ?>
                                <img src="<?= $urlPath ?>" alt="Avatar">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right">
		
							<li class="divider"></li>
							<li class="dropdown-header">Cerrar Sesion</li>
							<li><a tabindex="-1"
								href="<?= base_url() ?>index.php/login/logout"> <i class="fas fa-sign-out-alt mr-2"></i>OK
							</a></li>
						</ul>
					</div>
				</li>
				<li>
					<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
					<button class="btn btn-default" data-toggle="layout"
						data-action="side_overlay_toggle" type="button">
						<i class="fa fa-tasks"></i>
					</button>
				</li>
			</ul>
			<!-- END Header Navigation Right -->

			<!-- Header Navigation Left -->
			<ul class="nav-header pull-left">
				<li class="hidden-md hidden-lg">
					<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
					<button class="btn btn-default" data-toggle="layout"
						data-action="sidebar_toggle" type="button">
						<i class="fa fa-navicon"></i>
					</button>
				</li>
				<li class="hidden-xs hidden-sm">
					<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
					<button class="btn btn-default" data-toggle="layout"
						data-action="sidebar_mini_toggle" type="button">
						<i class="fa fa-ellipsis-v"></i>
					</button>
				</li>
			</ul>
			<!-- END Header Navigation Left -->
		</header>
		<!-- END Header -->