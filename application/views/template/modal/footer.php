 <!-- Footer -->
 			<?php
 				# extracción de usuario
 				$data_session = $this->session->userdata('logged_in');
 				//$nombre_completo = $data_session['nombre_completo'];
				//$tienda = strtoupper($data_session['tienda']);
				$idTienda = $data_session['id_tienda'];
				//$tiendas = $data_session['listaTiendas'];
				$idUsuario =  $data_session['id_usuario'];
				$usuarioNivel = $data_session['id_usuario_nivel'];
				$idKey = $data_session['idKey'];
 			?>
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
                
            </footer>
            <!-- END Footer -->
            <!-- Modal -->
            
            <!-- End Modal -->
            <!-- global url -->
            <input type="hidden" id="url" value="<?= base_url().'index.php/' ?>">
            <input type="hidden" id="base_url" value="<?= base_url() ?>">
            <input type="hidden" id="idTienda" name="idTienda" value="<?= $idTienda ?>">
            <input type="hidden" id="idTienda" name="idUsuario" value="<?= $idUsuario ?>">
            <input type="hidden" id="idKey" value="<?= $idKey ?>">
            <input type="hidden" id="usuarioNivel" value="<?= $usuarioNivel ?>">
            <!--  -->
        </div>
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
        <!-- Page Plugins -->
        <script src="<?=asset_url()?>js/plugins/html5sql/html5sql.js"></script>
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
        <script type="text/javascript">
	        $(function(){
	            // Init page helpers (Slick Slider plugin)
	            //App.initHelpers('slick');
	        });
        </script>
    </body>
</html>