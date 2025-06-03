<!DOCTYPE>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <title>xxxx</title>
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?=asset_url()?>img/favicons/favicon.png">

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
        <!-- Web fonts 
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
		-->
		<link rel="stylesheet" href="<?=asset_url()?>css/font.css">
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/slick/slick.min.css">
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/slick/slick-theme.min.css">
		<!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/datatables/jquery.dataTables.min.css">
		<!-- AutoComplete --> 
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/autocomplete/jquery-ui-1.10.4.custom.min.css">
		<!-- Select2 --> 
		<link rel="stylesheet" href="<?=asset_url()?>js/plugins/select2/select2.min.css">
		<!-- tags -->
		<link rel="stylesheet" href="<?=asset_url()?>js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
		<!-- OneUI CSS framework -->
        <link rel="stylesheet" id="css-main" href="<?=asset_url()?>css/oneui.css">
        <!-- editable --> 
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/editable/css/bootstrap-editable.css">
        <!-- sweetalert -->
		<link rel="stylesheet" href="<?=asset_url()?>js/plugins/sweetalert/sweetalert.css">
		<!-- datepicker -->
		<link rel="stylesheet" href="<?=asset_url()?>js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
		<!-- slick -->
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/slick/slick.min.css">
        <link rel="stylesheet" href="<?=asset_url()?>js/plugins/slick/slick-theme.min.css">
		<!-- qz-print -->
		<script src="<?=asset_url()?>js/plugins/qz-print-2/dependencies/rsvp-3.1.0.min.js"></script>
		<script src="<?=asset_url()?>js/plugins/qz-print-2/dependencies/sha-256.min.js"></script>
		<script src="<?=asset_url()?>js/plugins/qz-print-2/qz-tray.js"></script>
		
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
        <div id="page-container">
           