<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Entidades extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        
        $this->load->model(array(
            'entidad_model',
            'usuario_model',
            'articulo_model',
            'orden_model',
            'catalogos_model',
            'pagos_model',
            'listaprecios_model'
        ));
        
        $this->load->library('utilsfunc');
    }

    function index()
    {
        show_404();
    }

    function creditos() {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $id_usuario = $data_session['id_usuario'];
            $idEntidad = $this->uri->segment(3);
            $cols = array(
                'nombre_razon_social',
                'monto_credito',
                'SALDO',
                'dias_credito',
                'cod_entidad',
                'rfc',
                'id_entidad'
            );
            $entidad = $this->entidad_model->mostrar_entidad_id($idEntidad, $cols);
            $data['saldo'] = $this->utilsfunc->truncateFloat($entidad->SALDO);
            $data['menu'] = 'menu_clientes';
            $data['list'] = 'clientes';
            $data['entidad'] = $entidad;
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/lista_creditos', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function exportReporteAuxialEntidad() {
        if($this->session->userdata('logged_in')) {
            
            $idEntidad = $this->uri->segment(3);
            $desde = $this->uri->segment(4);
            $hasta = $this->uri->segment(5);
            
            $dWhere = "";
            if($desde != '' and $hasta != '') {
                $desde = substr($desde, 6, 4) . substr($desde, 3, 2) . substr($desde, 0, 2);
                $hasta = substr($hasta, 6, 4) . substr($hasta, 3, 2) . substr($hasta, 0, 2);
            } else {
                // mes actual
                $date = new DateTime('now');
                $desde = $date->format('Y') . $date->format('m') . '01'; // desde el primero de cada mes
                //$desde = $date->format('Ymd');
                $hasta = $date->format('Ymd');
            }
            
            $dWhere .= "DATE(cpc.fecha) BETWEEN '$desde' AND '$hasta' AND cpc.idEntidad=" . $idEntidad;
            
            $items =  $this->entidad_model->getRepAuxiliarEntidad($dWhere);
            
            // armado del excel
            $this->load->library('excel');
            $this->excel->getProperties()
                ->setCreator('')
                ->setLastModifiedBy('')
                ->setTitle('Reporte Auxiliar')
                ->setSubject('Reporte Auxiliar')
                ->setDescription('Reporte Auxiliar')
                ->setKeywords('Reporte Auxiliar')
                ->setCategory('Reporte Auxiliar');
            
            $this->excel->getActiveSheet()
            ->getStyle('A1:I1')
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            
            $this->excel->getActiveSheet()
            ->getStyle('A1:I1')
            ->getFill()
            ->getStartColor()
            ->setARGB('E5E1E1');
            
            $this->excel->getActiveSheet()
            ->getStyle("A1:I1")
            ->getFont()
            ->setBold(true);
            
            $this->excel->getActiveSheet()
            ->getColumnDimension('C')
            ->setWidth(46.29);
            
            
            $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'FECHA');
            $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'DOCUMENTO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'METODO_PAGO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'FOLIO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'CARGO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'ABONO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'SALDO');
            
         
            $i = 2;
            foreach ($items as $item) {
                
                $impSaldoAnt = number_format($item['impSaldoAnt'], 2);
                $impPagado = number_format($item['impPagado'], 2);
                $saldoFinal = ($item['saldoFinal'] == NULL) ? number_format($item['impSaldoInsoluto'], 2) : number_format($item['saldoFinal'], 2); // en calcelados no prorratea el saldo total
                
                if($item['idTipoComprobante']==19 or $item['idTipoComprobante']==20 or $item['idTipoComprobante']==21){
                    $impSaldoAnt = 0;
                }
               
                $this->excel->setActiveSheetIndex(0)->setCellValue('A' . $i, date('d/m/Y', strtotime($item['fechaPago'])));
                $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, $item['tipoComprobante']);
                $this->excel->setActiveSheetIndex(0)->setCellValue('C' . $i, $item['codMetodoPago']);
                $this->excel->setActiveSheetIndex(0)->setCellValue('D' . $i, $item['folio']);
                $this->excel->setActiveSheetIndex(0)->setCellValue('E' . $i, $impSaldoAnt) ;
                $this->excel->setActiveSheetIndex(0)->setCellValue('F' . $i, $impPagado);
                $this->excel->setActiveSheetIndex(0)->setCellValue('G' . $i, $saldoFinal);
              
                $i ++;
            }
            
            $range = 'A' . $i . ':' . 'A' . $i;
            $this->excel->getActiveSheet()
                ->getStyle($range)
                ->getNumberFormat()
                ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            
            $fileName = 'ReporteAuxiliar.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $fileName);
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('php://output');
            exit();
           
        }else{
            show_404();
        }
    }
    public function getReporteAuxialEntidad(){
        
        if ($this->session->userdata('logged_in')) {
            //$data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            
            $entidad = $this->catalogos_model->getSimpleResult(array('id_entidad'=>$idEntidad), 'entidad', array('id_entidad', 'cod_entidad', 'nombre_razon_social'), 'row');
            
            $dWhere = "";
            // dia actual
            $date = new DateTime('now');
            $desde = $date->format('Y') . $date->format('m') . '01'; // desde el primero de cada mes
            //$desde = $date->format('Ymd');
            $hasta = $date->format('Ymd');
            
            //$dWhere .= "DATE(cpc.fecha) BETWEEN '$desde' AND '$hasta' AND cpc.idEntidad=" . $idEntidad;
            $dWhere .= "cpc.idEntidad=" . $idEntidad;
            
            $items =  $this->entidad_model->getRepAuxiliarEntidad($dWhere);
            
            log_message('debug', 'itemsss' . print_r($items, TRUE));
            
            $item= array();
            $item['items'] = $items;
            $item['entidad'] = $entidad;
            
            $this->load->view('template/modal/header');
            $this->load->view('entidad/modal/rep_auxiliar_entidad', $item);
            $this->load->view('template/modal/footer');
            
        }else{
            show_404();
        }
        
    }
    
    public function getHistorialVentaCliente() {
        if ($this->session->userdata('logged_in')) {
            //$data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            
            $itemsO = $this->orden_model->getDocOrden("dc.idEntidad = " . $idEntidad . ' AND dc.idTipoComprobante = 4'); // solo cotizaciones
            $itemsV = $this->orden_model->getDocVenta("dc.idEntidad = " . $idEntidad . ' AND dc.totalArticulos is not null'); // Presupuestos, facturas, notas, facturas por docto
            
            $item = array();
            $items = array();
            
            foreach ($itemsO as $item) {
                array_push($items, $item);
            }
            
            foreach ($itemsV as $item) {
                array_push($items, $item);
            }
            
            $item['items'] = $items;
            
            $this->load->view('template/modal/header');
            $this->load->view('entidad/modal/historial_ventas_clientes', $item);
            $this->load->view('template/modal/footer');
            
        }else{
            show_404();
        }
    }
    
    public function getEntidadPropiedad(){
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            $idPropiedadTipo = $this->uri->segment(4);
            
            $data['catFormaPago'] = $this->catalogos_model->getSimpleResult(NULL, 'forma_pago_v33');
            $data['entidad'] = $this->catalogos_model->getSimpleResult(array('id_entidad'=>$idEntidad), 'entidad', array('id_entidad', 'cod_entidad', 'nombre_razon_social'), 'row');
            $data['propiedadTipo'] = $this->catalogos_model->getSimpleResult(NULL, 'propiedad_tipo');
            
            $this->load->view('template/modal/header');
            $this->load->view('entidad/modal/entidad_propiedad', $data);
            $this->load->view('template/modal/footer');
            
        }else{
            show_404();
        }
    }
    
    public function getCatBancoPropiedad(){
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            
            $idCatBanco = $this->uri->segment(3);
            log_message('debug', 'idCatBanco ' . $idCatBanco);
            $data['item'] = $this->catalogos_model->getSimpleResult(array('idCatBanco'=>$idCatBanco), 'cat_banco', NULL, 'row');
            log_message('debug', print_r($data, TRUE));
            $this->load->view('template/modal/header');
            $this->load->view('entidad/modal/cat_banco', $data);
            $this->load->view('template/modal/footer');
            
        }else{
            show_404();
        }
        
    }
    
    public function guardaCatBanco(){
        if($this->input->is_ajax_request()){
            
            $dReque = array();
            foreach ($_POST as $key => $value) {
                $dReque[$key] = $this->input->post($key);
            }
            $idCatBanco = (int)$dReque['idCatBanco'];
            log_message('debug', 'idCatBanco ' . $idCatBanco);
            if($idCatBanco==0){
                $idCatBanco=  $this->catalogos_model->simpleInsert('cat_banco', $dReque);
            }else{
                unset($dReque['idCatBanco']);
                $this->catalogos_model->simpleUpdate('cat_banco', $dReque, array('idCatBanco'=>$idCatBanco));
                log_message('debug', print_r($this->db->last_query(), TRUE));
            }
            echo json_encode(array(
                'msg'=>'Registro insertado correctamente',
                'type'=>'success'
            ));
            
        }else{
            show_404();
        }
    }
    
    public function guardaEntidadPropiedad(){
        if($this->input->is_ajax_request()){
            
            $dReque = array();
            foreach ($_POST as $key => $value) {
                $dReque[$key] = $this->input->post($key);
            }
            
            $idEntidadPropiedad = $dReque['id_entidad_propiedad'];
            unset($dReque['txtCodEntidad']);
            unset($dReque['id_entidad_propiedad']);
            
            if($idEntidadPropiedad==0){
                $idEntidadPropiedad = $this->catalogos_model->simpleInsert('entidad_propiedad', $dReque);
            }else{
                $this->catalogos_model->simpleUpdate('entidad_propiedad', $dReque, array('id_entidad_propiedad'=>$idEntidadPropiedad));
            }
            
            echo json_encode(array(
                'msg'=>'Registro agregado correctamente',
                'type'=>'success',
                'idEntidadPropiedad'=>$idEntidadPropiedad
            ));
            
        }else{
            show_404();
        }
    }
    
    public function bancoSelect(){
        if ($this->input->is_ajax_request()) {
            $search = $this->input->post('search');
            $result = $this->entidad_model->bancoSelect($search);
            echo json_encode($result);
        } else {
            show_404();
        }
    }
    
    public function cuentaBancoSelect(){
        if ($this->input->is_ajax_request()) {
            $search = $this->input->post('search');
            $idEntidadPropiedad = $this->input->post('idEntidadPropiedad');
            $idEntidad = $this->input->post('idEntidad');
            $result = $this->entidad_model->cuentaBancoSelect($search, $idEntidadPropiedad, $idEntidad);
            echo json_encode($result);
        } else {
            show_404();
        }
    }
    
    function historialOrdenes()
    {
        if ($this->input->is_ajax_request()) {
            $idEntidad = $this->input->post('idEntidad');
            $desde = $this->input->post('desde');
            $hasta = $this->input->post('hasta');
            $idConPago = $this->input->post('idConPago');
            if ($desde == '') {
                $desde = (new DateTime())->format('d-m-Y');
            }
            if ($hasta == '') {
                $hasta = (new DateTime())->format('d-m-Y');
            }
            $dataWhere = array();
            if ($idConPago == 0) {
                $dataWhere = array(
                    'orden_c.id_entidad' => $idEntidad,
                    'DATE_FORMAT(orden_c.fecha,"%d-%m-%Y")>=' => $desde,
                    'DATE_FORMAT(orden_c.fecha,"%d-%m-%Y")<=' => $hasta,
                    'orden_c.id_caja!=' => NULL
                );
            } else {
                $dataWhere = array(
                    'orden_c.id_entidad' => $idEntidad,
                    'DATE_FORMAT(orden_c.fecha,"%d-%m-%Y")>=' => $desde,
                    'DATE_FORMAT(orden_c.fecha,"%d-%m-%Y")<=' => $hasta,
                    'orden_c.id_condiciones_pago' => $idConPago,
                    'orden_c.id_caja!=' => NULL
                );
            }
            $items = $this->orden_model->listado_ordenes($dataWhere);
            echo json_encode(array(
                'items' => $items
            ));
        } else {
            show_404();
        }
    }

    // listado estado de cuenta creditos
    function getListEdoCuentaCre()
    {
        if ($this->input->is_ajax_request()) {
            
            $idEntidad = $this->input->post('idEntidad');
            $edoCred = $this->input->post('edoCred');
            $tipoDoc = $this->input->post('tipoDoc');
            
            if ($edoCred != 0) {
                // vigentes
                if ($edoCred == 1) {
                    $dataWhere = array(
                        'ec.id_entidad' => $idEntidad,
                        'ec.saldo !=' => 0,
                        'datediff(ec.fecha_vence, now()) >=' => 0,
                        'ec.id_condiciones_pago' => $tipoDoc,
                        'ec.fecha_vence !=' => NULL
                    );
                    // vencidos
                } else if ($edoCred == 2) {
                    $dataWhere = array(
                        'ec.id_entidad' => $idEntidad,
                        'ec.saldo !=' => 0,
                        'datediff(ec.fecha_vence, now()) <=' => 0,
                        'ec.id_condiciones_pago' => $tipoDoc,
                        'ec.fecha_vence !=' => NULL
                    );
                }
            } else {
                // todos
                $dataWhere = array(
                    'ec.id_entidad' => $idEntidad,
                    'ec.saldo !=' => 0,
                    'ec.id_condiciones_pago' => $tipoDoc,
                    'ec.fecha_vence !=' => NULL
                );
            }
            
            // si la consulta es invocada desde saldo por clientes
            if ($idEntidad == '') {
                unset($dataWhere['ec.id_entidad']);
            }
            
            // $items = $this->orden_model->listado_ordenes($dataWhere);
            $items = $this->entidad_model->getListEdoCuentaEntJOIN($dataWhere);
            
            $totalVenta = 0;
            $saldo = 0;
            $pagado = 0;
            
            // sumando totales
            $totalVenta = number_format(array_sum(array_column($items, 'importe')), 2);
            $saldo = number_format(array_sum(array_column($items, 'saldo')), 2);
            $pagado = number_format(array_sum(array_column($items, 'total_pagado')), 2);
            
            echo json_encode(array(
                'items' => $items,
                'totalVenta' => $totalVenta,
                'saldo' => $saldo,
                'pagado' => $pagado
            ));
        } else {
            show_404();
        }
    }

    public function modalListadoEntidad()
    {
        if ($this->session->userdata('logged_in')) {
            
            $entiTipo = $this->uri->segment(3);
            
            $dWhere = array(
                'entidad_tipo' => $entiTipo
            );
            
            $cols = array(
                'nombre_razon_social',
                'rfc',
                'id_entidad',
                'cod_entidad'
            );
            
            $items = $this->catalogos_model->getSimpleResult($dWhere, 'entidad', $cols);
            
            $data['seccion'] = 'Proveedores';
            $data['tipo_entidad'] = 'p';
            $data['menu'] = 'menu_proveedores';
            $data['lblBtnAdd'] = 'Agregar Proveedor';
            $data['items'] = $items;
            
            $this->load->view('template/modal/header');
            $this->load->view('entidad/lista_entidad_modal', $data);
            $this->load->view('template/modal/footer');
        } else {
            show_404();
        }
    }

    function listado_ordenes()
    {
        if ($this->session->userdata('logged_in')) {
            // $data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->input->post('idEntidad');
            $edoCred = $this->input->post('edoCred');
            
            if ($edoCred != 0) {
                // vigentes
                if ($edoCred == 1) {
                    $dataWhere = array(
                        'orden_c.id_entidad' => $idEntidad,
                        'orden_c.saldo !=' => 0,
                        'datediff(orden_c.fecha_vence, now()) >=' => 0,
                        'orden_c.id_condiciones_pago' => 2,
                        'orden_c.id_caja !=' => NULL
                    );
                    // vencidos
                } else if ($edoCred == 2) {
                    $dataWhere = array(
                        'orden_c.id_entidad' => $idEntidad,
                        'orden_c.saldo !=' => 0,
                        'datediff(orden_c.fecha_vence, now()) <=' => 0,
                        'orden_c.id_condiciones_pago' => 2,
                        'orden_c.id_caja !=' => NULL
                    );
                }
            } else {
                // todos
                $dataWhere = array(
                    'orden_c.id_entidad' => $idEntidad,
                    'orden_c.saldo !=' => 0,
                    'orden_c.id_caja !=' => NULL
                );
            }
            
            // si la consulta es invocada desde saldo por clientes
            if ($idEntidad == '') {
                unset($dataWhere['orden_c.id_entidad']);
            }
            
            $items = $this->orden_model->listado_ordenes($dataWhere);
            
            $totalVenta = 0;
            $saldo = 0;
            $pagado = 0;
            
            // sumando totales
            $totalVenta = number_format(array_sum(array_column($items, 'total')), 2);
            $saldo = number_format(array_sum(array_column($items, 'saldo')), 2);
            $pagado = number_format(array_sum(array_column($items, 'total_pagado')), 2);
            
            echo json_encode(array(
                'items' => $items,
                'totalVenta' => $totalVenta,
                'saldo' => $saldo,
                'pagado' => $pagado
            ));
        } else {
            echo show_404();
        }
    }

    function lista_descuentos_json()
    {
        $id_entidad = $this->input->post('id_entidad');
        $items = $this->entidad_model->listado_descuentos($id_entidad);
        $r_array = array(
            "items" => $items
        );
        echo json_encode($r_array);
    }

    /*
     * function guardaDescuentos(){
     * $articulo = ($this->input->post('articulo')=="") ? 0 : $this->input->post('articulo');
     * $linea = $this->input->post('linea');
     * $sublinea = $this->input->post('sublinea');
     * $descuento = $this->input->post('descuento');
     * $descripcion = $this->input->post('descrip');
     * $id_entidad = $this->input->post('id_entidad');
     * $data = array("id_articulo"=>$articulo,
     * "linea"=>$linea,
     * "sublinea"=>$sublinea,
     * "descuento"=>$descuento,
     * "descripcion"=>$descripcion,
     * "id_entidad"=>$id_entidad
     * );
     * $this->entidad_model->insert_descuento($data);
     * echo json_encode(array("msg"=>"success"));
     * }
     */
    function menu_clientes()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $id_usuario = $data_session['id_usuario'];
            $data['seccion'] = 'Men&uacute de Clientes';
            $data['nombre_corto'] = 'Cliente';
            $data['c_1'] = 'nuevo_cliente';
            $data['c_2'] = 'clientes';
            $data['menus'] = $this->usuario_model->subMenusUsuario($id_usuario, 2); // menu_id : 1 - Table menu_sub
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/menu_entidad', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function menu_proveedores()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $id_usuario = $data_session['id_usuario'];
            $data['seccion'] = 'Men&uacute; de Proveedores';
            $data['nombre_corto'] = 'Proveedor';
            $data['c_1'] = 'nuevo_proveedor';
            $data['c_2'] = 'proveedores';
            $data['menus'] = $this->usuario_model->subMenusUsuario($id_usuario, 1); // menu_id : 1 - Table menu_sub
            $data_menus['menus'] = $data_session['menus'];
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/menu_entidad', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function clientes() {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $criterio = $this->input->post('criterio-entidad');
            $tVentana = $this->uri->segment(3);
            // $data['entidades'] = $this->entidad_model->obtener_entidades($criterio, 'c');
            $data['seccion'] = 'Clientes';
            $data['tipo_entidad'] = 'c';
            $data['menu'] = 'menu_clientes';
            $data['lblBtnAdd'] = 'Agregar Cliente';
            $data['tVentana'] = $tVentana; // tipo modal, m = modal, t = template
            
            if($tVentana=='t') {
                $this->load->view('template/header', $data_menus);
                $this->load->view('entidad/lista_entidad', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/modal/header', $data_menus);
                $this->load->view('entidad/lista_entidad', $data);
                $this->load->view('template/modal/footer');
            }
             
        } else {
            redirect('login', 'refresh');
        }
    }

    // vista cuentas por cobrar por documento
    function viewCuentasPorCobrar() {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $criterio = $this->input->post('criterio-entidad');
            // $data['entidades'] = $this->entidad_model->obtener_entidades($criterio, 'c');
            $data['seccion'] = 'Clientes';
            $data['tipo_entidad'] = 'c';
            $data['menu'] = 'menu_clientes';
            $data['list'] = 'clientes';
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/lista_creditos_documentos', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    // vista cuentas por cobrar por cliente
    function viewCuentasCliente()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $criterio = $this->input->post('criterio-entidad');
            // $data['entidades'] = $this->entidad_model->obtener_entidades($criterio, 'c');
            $data['seccion'] = 'Clientes';
            $data['tipo_entidad'] = 'c';
            $data['menu'] = 'menu_clientes';
            $data['list'] = 'clientes';
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/lista_creditos_clientes', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function proveedores()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $criterio = $this->input->post('criterio-entidad');
            
            $tVentana = $this->uri->segment(3);
            
            $data['tVentana'] = $tVentana; // tipo modal, m = modal, t = template
            $data['seccion'] = 'Proveedores';
            $data['tipo_entidad'] = 'p';
            $data['menu'] = 'menu_proveedores';
            $data['lblBtnAdd'] = 'Agregar Proveedor';
            
            if($tVentana=='t'){
                $this->load->view('template/header', $data_menus);
                $this->load->view('entidad/lista_entidad', $data);
                $this->load->view('template/footer');
            }else{
                $this->load->view('template/modal/header', $data_menus);
                $this->load->view('entidad/lista_entidad', $data);
                $this->load->view('template/modal/footer');
            }
            
        } else {
            redirect('login', 'refresh');
        }
    }

    function nuevo_proveedor()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $data = $this->set_nueva_entidad();
            $metodosPago = $this->catalogos_model->getListMetodoPago();
            $data['type'] = 'p';
            $data['title'] = 'Nuevo Proveedor';
            $data['seccion'] = 'Proveedor';
            $data['row'] = NULL;
            $data['artTipoEntPro'] = '';
            $data['artTipoEntCli'] = 'style="display:none !important;"';
            $data['menu'] = 'menu_proveedores';
            $data['list'] = 'proveedores';
            $data['metodosPago'] = $metodosPago;
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/entidad', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function nuevo_cliente()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            $data_menus['menus'] = $data_session['menus'];
            $data = $this->set_nueva_entidad();
            $metodosPago = $this->catalogos_model->getListMetodoPago();
            $data['type'] = 'c';
            $data['title'] = 'Nuevo Cliente';
            $data['seccion'] = 'Cliente';
            $data['row'] = NULL;
            $data['artTipoEntPro'] = 'style="display:none !important;"';
            $data['artTipoEntCli'] = '';
            $data['menu'] = 'menu_proveedores';
            $data['list'] = 'proveedores';
            $data['metodosPago'] = $metodosPago;
            $this->load->view('template/header', $data_menus);
            $this->load->view('entidad/entidad', $data);
            $this->load->view('template/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    /*
     * function nuevo(){
     * if($this->session->userdata('logged_in')){
     * $data['menu'] = 'menu_proveedores';
     * $data['list'] = 'proveedores';
     * $this->load->view('template/header');
     * $this->load->view('entidad/entidad',$data);
     * $this->load->view('template/footer');
     * }else{
     * redirect('login', 'refresh');
     * }
     * }
     */
    public function listaContactos()
    {
        $id_entidad = $this->input->post('id_entidad');
        $lista = $this->entidad_model->getListaPropiedades(array('ep.id_entidad'=>$id_entidad));
        echo json_encode($lista);
    }

    public function entidadesSelect(){
        if($this->input->is_ajax_request()){
            $tipo_entidad = ($this->input->post('tipo')!='') ? $this->input->post('tipo') : NULL;
            $search = $this->input->post('search');
            $result = $this->entidad_model->entidadesSelect($search, $tipo_entidad);
            echo json_encode($result);
        }else{
            show_404();
        }
    }

    // listado de entidades
    public function lista_entidades(){
        $tipoEntidad = $this->input->post('tipo_entidad');
        $items = $this->input->post('items');
        
        $param = array(
            'tipoEntidad' => $tipoEntidad,
            'items' => $items
        );
        
        $result = $this->entidad_model->obtenerEntidad($param);
        
        echo json_encode($result);
    }

    function ver_propiedad()
    {
        $id_entidad_propiedad = $this->input->post('id_entidad_propiedad');
        $row = $this->entidad_model->obtener_propiedad($id_entidad_propiedad);
        // sleep(2);
        echo json_encode($row);
    }

    function guardar_propiedad()
    {
        $id_entidad = $this->input->post('id_entidad');
        $id_entidad_propiedad = $this->input->post('id_entidad_propiedad');
        $id_propiedad_tipo = $this->input->post('cli_select_tipo_contacto');
        $valor = $this->input->post('cli_prop_nombre');
        $tipo = $this->input->post('cli_pro_tipo');
        $c_entidad_prop = $this->input->post('c_entidad_prop');
        $data = array(
            'id_entidad' => $id_entidad,
            'id_propiedad_tipo' => $id_propiedad_tipo,
            'valor' => $valor,
            'tipo' => strtoupper($tipo)
        );
        $mensaje = "";
        if ($c_entidad_prop == "new") {
            $this->entidad_model->insertar_propiedad($data);
            $mensaje = "Registro agregado correctamente";
        } else {
            $estado = $this->entidad_model->actualizar_propiedad($data, $id_entidad_propiedad);
            $mensaje = ($estado) ? "Registro modificado correctamente" : "No se actualizo el registro";
        }
        $r_array = array(
            "type" => "info",
            "message" => $mensaje,
            "id_entidad_propiedad" => $id_entidad
        );
        // sleep(2);
        echo json_encode($r_array);
    }

    function eliminar_propiedad()
    {
        $id_entidad_propiedad = $this->input->post('id_entidad_propiedad');
        $estado = $this->entidad_model->eliminar_propiedad($id_entidad_propiedad);
        $mensaje = ($estado) ? "" : "No se elimino el registro";
        $r_array = array(
            "type" => "info",
            "message" => $mensaje
        );
        echo json_encode($r_array);
    }

    function eliminar()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->session->userdata('logged_in')) {
                $data_session = $this->session->userdata('logged_in');
                $id_usuario = $data_session['id_usuario'];
                
                $id_entidad = $this->input->post('id_entidad');
                $data = array(
                    'activo' => '0',
                    'fecha_baja' => date('Y-m-d H:i:s'),
                    'id_usuario_baja' => $id_usuario
                );
                $estado = $this->entidad_model->eliminar_entidad($data, $id_entidad);
                $mensaje = ($estado) ? 'Registro eliminado correctamente' : 'No se elimino el registro';
                echo json_encode(array(
                    'type' => 'info',
                    'message' => $mensaje
                ));
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    function guardar_cliente_mostrador()
    {
        $c_entidad = $this->input->post('c_entidad');
        $id_entidad = $this->input->post('id_entidad');
        $nombre_razon_social = $this->input->post('cli-nombre-razon');
        $rfc = $this->input->post('cli-rfc');
        $calle = $this->input->post('cli-calle');
        $n_interior = $this->input->post('cli-num-int');
        $n_exterior = $this->input->post('cli-num-ext');
        $colonia = $this->input->post('cli-colonia');
        $localidad = $this->input->post('cli-localidad');
        $referencia = $this->input->post('cli-referencia');
        $region = $this->input->post('cli-pais');
        $poblacion = $this->input->post('cli-poblacion');
        $estado = $this->input->post('cli-estado');
        $cp = $this->input->post('cli-cp');
        $tipo_entidad = $this->input->post('tipo_entidad');
        // $cod_entidad = $this->input->post('cli-cod');
        $ciudad = $this->input->post('cli-ciudad');
        $correos = $this->input->post('cli-correos');
        $telefonos = $this->input->post('cli-telefonos');
        $nombre_nombre = $this->input->post('cli-nombre-nombre');
        $a_materno = ($this->input->post('cli-nombre-materno') != "") ? $this->input->post('cli-nombre-materno') : '';
        $a_paterno = ($this->input->post('cli-nombre-paterno') != "") ? $this->input->post('cli-nombre-paterno') : '';
        $tipo_persona = $this->input->post('opt_tipo_persona');
        $idMetodoPago = $this->input->post('cbMetodoPago');
        $ref = $this->input->post('txtNumCuenPagoCli');
        
        $nombre = "";
        
        $type = 'success';
        $msg = '';
        $existe = FALSE;
        
        $data = array(
            'entidad_tipo' => $tipo_entidad,
            'nombre_razon_social' => strtoupper($nombre_razon_social),
            'rfc' => strtoupper($rfc),
            'calle' => strtoupper($calle),
            'n_interior' => strtoupper($n_interior),
            'n_exterior' => strtoupper($n_exterior),
            'colonia' => strtoupper($colonia),
            'localidad' => strtoupper($localidad),
            'referencia' => strtoupper($referencia),
            'region' => strtoupper($region),
            'ciudad' => strtoupper($ciudad),
            'cp' => $cp,
            'poblacion' => strtoupper($poblacion),
            'estado' => strtoupper($estado),
            'id_tienda' => 1,
            'a_paterno' => strtoupper($a_paterno),
            'a_materno' => strtoupper($a_materno),
            'tipo_persona' => $tipo_persona,
            'nombre' => strtoupper($nombre_nombre),
            'pais' => strtoupper($region),
            'id_metodo_pago' => $idMetodoPago,
            'ref' => $ref
        );
        if ($c_entidad == 'new') {
            // valida si existe el rfc
            $entidad = $this->entidad_model->getEntidad(array(
                'rfc' => $rfc
            ), array(
                'rfc',
                'cod_entidad'
            ));
            if ($entidad['rfc'] != $rfc) {
                $type = 'success';
                $msg = 'Registro agregado correctamente';
                $existe = FALSE;
                $id_entidad = $this->entidad_model->insertar_entidad($data);
                // actualiza el id en cod_entidad
                $this->entidad_model->actualizar_entidad(array(
                    'cod_entidad' => $id_entidad
                ), $id_entidad);
                // agrega telefonos y correos
                $this->agrega_lista_propiedad_entidad($correos, $id_entidad, 2);
                $this->agrega_lista_propiedad_entidad($telefonos, $id_entidad, 1);
            } else {
                $type = 'warning';
                $msg = 'El RFC ya existe, con el codigo ' . $entidad['cod_entidad'];
                $existe = TRUE;
            }
        } else {
            $rows_affect = $this->entidad_model->actualizar_entidad($data, $id_entidad);
            $this->entidad_model->borra_propiedad_entidad(1, $id_entidad);
            $this->entidad_model->borra_propiedad_entidad(2, $id_entidad);
            $this->agrega_lista_propiedad_entidad($correos, $id_entidad, 2);
            $this->agrega_lista_propiedad_entidad($telefonos, $id_entidad, 1);
            $msg = "Registro editado correctamente";
        }
        
        $r_array = array(
            'type' => $type,
            'msg' => $msg,
            'id_entidad' => $id_entidad,
            'nombre_completo' => strtoupper($nombre),
            'existeRfc' => $existe
        );
        echo json_encode($r_array);
    }

    public function validaCodEntidad()
    {
        if ($this->input->is_ajax_request()) {
            
            // $codEntidad = $this->input->post('codEntidad');
            $dWhere = $this->input->post('dWhere');
            
            // $item = $this->entidad_model->getEntidad(array('cod_entidad'=>$codEntidad), $cols=array('cod_entidad', 'nombre_razon_social'));
            $item = $this->entidad_model->getEntidad($dWhere, array(
                'cod_entidad',
                'nombre_razon_social'
            ));
            
            echo json_encode(array(
                'item' => $item
            ));
        } else {
            show_404();
        }
    }

    // agregar lista masiva de telefonos, correos, contactos
    function agrega_lista_propiedad_entidad($l_valores, $id_entidad, $id_propiedad_tipo)
    {
        $data_prop = array();
        $lista_valores = explode(",", $l_valores);
        if (count($lista_valores) > 0) {
            foreach ($lista_valores as $indice => $valor) {
                $dataR = array();
                if ($valor != '') {
                    $dataR = array(
                        "id_propiedad_tipo" => $id_propiedad_tipo,
                        "id_entidad" => $id_entidad,
                        "valor" => $valor
                    );
                }
                array_push($data_prop, $dataR);
            }
            if (! empty($dataR)) {
                $c_affect = $this->entidad_model->inserta_correos_entidad($data_prop);
            }
        }
    }

    public function guardar(){
        if($this->input->is_ajax_request()){
            
            if ($this->session->userdata('logged_in')) {
                
                $data_session = $this->session->userdata('logged_in');
                //$idUsuario = $data_session['id_usuario'];
                
                $c_entidad = $this->input->post('c_entidad');
                $id_entidad = $this->input->post('id_entidad');
                $nombre_razon_social = $this->input->post('cli-nombre-razon');
                $rfc = $this->input->post('cli-rfc');
                $calle = $this->input->post('cli-calle');
                $n_interior = $this->input->post('cli-num-int');
                $n_exterior = $this->input->post('cli-num-ext');
                $colonia = $this->input->post('cli-colonia');
                // $localidad = $this->input->post('cli-localidad');
                // $referencia = $this->input->post('cli-referencia');
                $region = $this->input->post('cli-pais');
                $poblacion = $this->input->post('cli-poblacion');
                $estado = $this->input->post('cli-estado');
                $descuento = NULL;
                $credito = ($this->input->post('cli-credito') != '') ? $this->input->post('cli-credito') : 0;
                $dias_credito = ($this->input->post('cli-dcredito') != '') ? $this->input->post('cli-dcredito') : 0;
                $cp = $this->input->post('cli-cp');
                $tipo_entidad = $this->input->post('tipo_entidad');
                $cod_entidad = $this->input->post('cli-cod');
                $nombre_nombre = $this->input->post('cli-nombre-nombre');
                $tipo_persona = $this->input->post('opt_tipo_persona');
                //$idMetodoPago = $this->input->post('cbMetodoPago');
                $ref = $this->input->post('cli-refpago');
                $itemsEntCon = json_decode($this->input->post('itemsContacto')); // entidades contactos
                $direccines = json_decode($this->input->post('direcciones'), TRUE); // entidades contactos
                
                $codMetPago = $this->input->post('codMetPago');
                $codFormaPago = $this->input->post('codFormaPago');
                $codUsoCFDI = $this->input->post('codUsoCFDI');
                
                $credito = str_replace('$', '', $credito);
                $credito = str_replace(',', '', $credito);
                
                $data = array(
                    'codMetPago'=>$codMetPago,
                    'codFormaPago'=>$codFormaPago,
                    'codUsoCFDI'=>$codUsoCFDI,
                    'cod_entidad' => strtoupper($cod_entidad),
                    'entidad_tipo' => $tipo_entidad,
                    'nombre_razon_social' => strtoupper($nombre_razon_social),
                    'rfc' => strtoupper($rfc),
                    'calle' => strtoupper($calle),
                    'n_interior' => strtoupper($n_interior),
                    'n_exterior' => strtoupper($n_exterior),
                    'colonia' => strtoupper($colonia),
                    'cp' => $cp,
                    'dias_credito' => $dias_credito,
                    'monto_credito' => (double) $credito,
                    'descuento' => $descuento,
                    'estado' => strtoupper($estado),
                    'id_tienda' => 1,
                    'tipo_persona' => $tipo_persona,
                    'nombre' => strtoupper($nombre_nombre),
                    'region' => strtoupper($region),
                    'poblacion' => $poblacion,
                    'ref' => $ref
                );
                //log_message('debug', 'idEntidad ' . $id_entidad);
                
                $objEdoEnt = $this->entidad_model->saveEntidadPro($id_entidad, $data, $itemsEntCon, $direccines);
                
                echo json_encode(array(
                    'type' => 'success',
                    'msg' => 'Registro guardado correctamente',
                    'objEdoEnt' => $objEdoEnt
                ));
                
            }else{
                show_404();
            }
            
        }else{
            show_404();
        }
    }

    // muestra la entidad, correos y telefonos para su consulta y modificaion desde ordenes de compra
    function mostrar_entidad_venta_ordenes()
    {
        if($this->input->is_ajax_request()){
            
            $idEntidad = $this->input->post('id_entidad');
            $entidad = $this->entidad_model->getEntidad(array('id_entidad'=>$idEntidad));
            $list_correos = $this->entidad_model->obtener_lista_propiedad_correo($idEntidad);
            $list_telefonos = $this->entidad_model->obtener_lista_propiedad_telefono($idEntidad);
            
            $correos = '';
            $telefonos = '';
            
            foreach ($list_correos as $row_c){
                $correos .= $row_c['valor'] . ',';
            }
            foreach ($list_telefonos as $row_t){
                $telefonos .= $row_t['valor'] . ',';
            }
            
            $r_array = array(
                'entidad' => $entidad,
                'correos' => $correos,
                'telefonos' => $telefonos
            );
            echo json_encode($r_array);
            
        }else{
            show_404();
        }
    }

    // muestra la entidad desde ordenes de compra
    public function mostrarEntidadId()
    {
        if ($this->input->is_ajax_request()) {
            
            $idEntidad = $this->input->post('id_entidad');
            $idTienda = $this->input->post('idTienda');
            
            $entidad = $this->entidad_model->getEntidad(array('id_entidad'=>$idEntidad));
            //$list_correos = $this->entidad_model->obtener_lista_propiedad_correo($idEntidad);
            
            $itemsArticulos = $this->listaprecios_model->getJoinListaPrecios(array(
                'ac.idEntidad'=>$idEntidad
            ));
            
//             $correos = '';
//             foreach ($list_correos as $row) {
//                 $correos .= $row['valor'] . ',';
//             }
            echo json_encode(array(
                'entidad'=>$entidad,
                'correos'=>NULL,
                'itemsArticulos'=>$itemsArticulos
            ));
        } else {
            show_404();
        }
    }

    public function mostrar_entidad() {
        if ($this->session->userdata('logged_in')) {
            
            $data_session = $this->session->userdata('logged_in');
            $usuarioNivel = $data_session['id_usuario_nivel'];
            $data_menus['menus'] = $data_session['menus'];
            
            $id_entidad = $this->uri->segment(3);
            $tipoEntidad = $this->uri->segment(4); // c = cliente, p = proveedor
            $tipoTemplete = $this->uri->segment(5); // tipo modal, m = modal, t = template
            
            $item = $this->entidad_model->obtener_entidad($id_entidad);
            $itemsCon = json_encode($this->entidad_model->getListaPropiedades(array('ep.id_entidad'=>$id_entidad)));
            $direcciones = json_encode($this->entidad_model->getDireccionEntidad(array('en.id_entidad'=>$id_entidad)));
            
            $metodosPago = NULL;
            $formaPago = NULL;
            $usoCFDI = NULL;
            
            $desTxCod = '';
            
            if ($item != NULL)
                $desTxCod = 'readonly';
            
            $data = array();
            $data['direcciones'] = $direcciones;
            $data['itemsCon'] = $itemsCon;
            
            $data['item'] = $item;
            $data['desTxCod'] = $desTxCod;
            $data['esCli'] = ($item['esCliente'] == 1) ? 'checked' : '';
            $data['esPro'] = ($item['esProveedor'] == 1) ? 'checked' : '';
            
            $div_f = '';
            $div_m = '';
            $opt_f = '';
            $opt_m = '';
            
            if ($item['tipo_persona'] == 'f') {
                $div_m = 'style="display:none !important;"';
                $opt_f = 'checked="checked"';
            } else {
                $div_f = 'style="display:none !important;"';
                $opt_m = 'checked="checked"';
            }
            
            $data['div_f'] = $div_f;
            $data['div_m'] = $div_m;
            $data['opt_f'] = $opt_f;
            $data['opt_m'] = $opt_m;
            $data['tipoEntidad'] = $tipoEntidad;
            
            $formaPago = $this->catalogos_model->getSimpleResult(NULL, 'forma_pago_v33');
            
            if ($tipoEntidad == "c") {
                
                $metodosPago = $this->catalogos_model->getSimpleResult(NULL, 'metodo_pago_v33');
                $usoCFDI = $this->catalogos_model->getSimpleResult(NULL, 'uso_cfdi_v33');
                
                $data['title'] = 'Editar Cliente';
                $data['seccion'] = 'Cliente';
                $data['artTipoEntPro'] = 'style="display:none !important;"';
                $data['artTipoEntCli'] = '';
                $data['menu'] = 'menu_clientes';
                $data['list'] = 'clientes';
                $showMFP = '';
                
            } else {
                
                $data['title'] = 'Editar Proveedor';
                $data['seccion'] = 'Proveedor';
                $data['artTipoEntPro'] = '';
                $data['artTipoEntCli'] = 'style="display:none !important;"';
                $data['menu'] = 'menu_proveedores';
                $data['list'] = 'proveedores';
                $showMFP = 'style="display: none;"';
                
            }
            
            $data['formaPago'] = $formaPago;
            $data['usoCFDI'] = $usoCFDI;
            $data['metodosPago'] = $metodosPago;
            $data['jsonUsoCFDI'] = json_encode($usoCFDI);
            
            $data['showMFP'] = $showMFP;
            $data['c_entidad'] = 'edit';
            
            $data['id_metodo_pago'] = $item['id_metodo_pago'];
            $data['ref'] = $item['ref'];
            
            
            if ($tipoTemplete == 't') {
                $data['invisibleProp'] = '';
                $data['hiddenProp'] = '';
                $this->load->view('template/header', $data_menus);
                $this->load->view('entidad/entidad', $data);
                $this->load->view('template/footer');
            } else {
                if($usuarioNivel<=2){
                    // mostrando campos especiales en modal solo al administrador
                    $data['invisibleProp'] = '';
                }else{
                    $data['invisibleProp'] = 'invisible';
                }
                $data['hiddenProp'] = 'hidden';
                $this->load->view('template/modal/header', $data_menus);
                $this->load->view('entidad/entidad', $data);
                $this->load->view('template/modal/footer');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    function set_nueva_entidad()
    {
        $data['cod_entidad'] = '';
        $data['tipo_persona'] = '';
        $data['rfc'] = '';
        $data['nombre_razon_social'] = '';
        $data['nombre'] = '';
        $data['a_paterno'] = '';
        $data['a_materno'] = '';
        $data['calle'] = '';
        $data['n_interior'] = '';
        $data['n_exterior'] = '';
        $data['poblacion'] = '';
        $data['colonia'] = '';
        $data['ciudad'] = '';
        $data['referencia'] = '';
        $data['localidad'] = '';
        $data['cp'] = '';
        $data['region'] = 'MEXICO';
        $data['estado'] = '';
        $data['dias_credito'] = '';
        $data['monto_credito'] = '';
        $data['saldo'] = '';
        $data['descuento'] = '';
        $data['div_f'] = '';
        $data['div_m'] = 'style="display:none !important;"';
        $data['opt_f'] = 'checked="checked"';
        $data['opt_m'] = '';
        $data['c_entidad'] = 'new';
        $data['id_entidad'] = '0';
        $data['id_metodo_pago'] = '';
        $data['ref'] = '';
        return $data;
    }
    
    public function correosSelect2(){
        if ($this->input->is_ajax_request()) {
            $idEntidad = $this->input->post('id_entidad');
            $items = $this->catalogos_model->getSimpleResult(array('id_entidad'=>$idEntidad, 'id_propiedad_tipo'=>2), 'entidad_propiedad', array('valor'));
            echo json_encode($items);
        }else{
            show_404();
        }
    }
    
    public function lista_correos()
    {
        if ($this->input->is_ajax_request()) {
            $id_entidad = $this->input->post('id_entidad');
            $items = $this->getListaCorreos($id_entidad);
            echo json_encode($items);
        }
    }

    function getEntidadSaldosCorreo()
    {
        if ($this->input->is_ajax_request()) {
            $idEntidad = $this->input->post('id_entidad');
            $itemsCorreos = $this->getListaCorreos($id_entidad);
            $entidad = $this->entidad_model->getEntidad(array('id_entidad'=>$idEntidad), array('monto_credito','SALDO'));
            
            echo json_encode(array(
                'correos' => $itemsCorreos,
                'entidad' => $entidad
            ));
        } else {
            show_404();
        }
    }

    private function getListaCorreos($idEntidad)
    {
        $list_correos = $this->entidad_model->obtener_lista_propiedad_correo($idEntidad);
        $correos = NULL;
        foreach ($list_correos as $row_c) {
            $correos .= $row_c['valor'] . ",";
        }
        return $correos;
    }

    // reemplazado
    function getArticulosProveedor()
    {
        $idEntidad = $this->input->post('id_entidad');
        $items = $this->articulo_model->articuloProveedor($idEntidad);
        echo json_encode(array(
            'items' => $items
        ));
    }

    function eliminarArtProv()
    {
        $idEntidad = $this->input->post('idEntidad');
        $idArticulo = $this->input->post('idArticulo');
        $this->articulo_model->eliminarArtProv(array(
            'id_entidad' => $idEntidad,
            'id_articulo' => $idArticulo
        ));
        echo json_encode(array(
            'type' => 'success',
            'msg' => 'Registro eliminado'
        ));
    }

    function guardarArtProv()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->session->userdata('logged_in')) {
                
                $data_session = $this->session->userdata('logged_in');
                $idUsuario = $data_session['id_usuario'];
                
                $msg = '';
                $type = 'success';
                $idArticulo = $this->input->post('idArticulo');
                $idEntidad = $this->input->post('idEntidad');
                $inner = $this->input->post('inner');
                $master = $this->input->post('master');
                $action = $this->input->post('action');
                
                $data = array(
                    'id_articulo' => $idArticulo,
                    'id_entidad' => $idEntidad,
                    'inner_pack' => $inner,
                    'master_pack' => $master,
                    'id_usuario' => $idUsuario,
                    'fecha' => date('Y-m-d H:i:s')
                );
                
                if ($action == 'new') {
                    $this->articulo_model->insertaArtProv($data);
                    $msg = 'Registro insertado correctamente';
                } else {
                    $where = array(
                        'id_articulo' => $idArticulo,
                        'id_entidad' => $idEntidad
                    );
                    $this->articulo_model->actualizaArtProv($data, $where);
                    $msg = 'Registro actualizado correctamente';
                }
                
                echo json_encode(array(
                    'type' => $type,
                    'msg' => $msg
                ));
            } else {
                show_404();
            }
        } else {}
    }

    public function exportArtProveedor() {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            
            $idTienda = $data_session['id_tienda'];
            
            $idEntidad = $this->uri->segment(3);
            $rowEntidad = $this->entidad_model->getEntidad(array('id_entidad'=>$idEntidad));
            
            $nombreCom = $data_session['nombre_completo'];
            $tienda = $data_session['tienda'];
            
            $this->load->library('excel');
            $this->excel->getProperties()
                ->setCreator($nombreCom)
                ->setLastModifiedBy($nombreCom)
                ->setTitle("Lista de Articulos por proveedor")
                ->setSubject("Lista de Articulos por proveedor")
                ->setDescription("Lista de Articulos por proveedor")
                ->setKeywords("Lista de Articulos por proveedor")
                ->setCategory("Lista de Articulos por proveedor");
            $codEntidad = $rowEntidad['cod_entidad'];
            
            $this->excel->getActiveSheet()->setTitle(substr($tienda, 0, 15));
            
            $this->excel->getActiveSheet()
                ->getStyle('A1:G1')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            
            $this->excel->getActiveSheet()
                ->getStyle('A1:G1')
                ->getFill()
                ->getStartColor()
                ->setARGB('E5E1E1');
            $this->excel->getActiveSheet()
                ->getStyle("A1:G1")
                ->getFont()
                ->setBold(true);
            
            $this->excel->getActiveSheet()
                ->getColumnDimension('B')
                ->setWidth(46.29);
            
            $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'CODIGO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'ARTICULO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'ITEM');
            $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'COSTO');
            $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'INNER PACK');
            $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'MASTER PACK');
            $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'EXISTENCIA');

            $items = $this->articulo_model->articuloProveedor(array(
                'ap.idEntidad' => $idEntidad
            ));
            
            $i = 2;
            foreach ($items as $item) {
                $this->excel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item["claveArticulo"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, $item["articulo"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('C' . $i, $item["item"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('D' . $i, $item["costo"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('E' . $i, $item["innerPack"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('F' . $i, $item["masterPack"]);
                $this->excel->setActiveSheetIndex(0)->setCellValue('G' . $i, $item["existencia"]);
                $i ++;
            }
            $range = 'A1:' . 'A' . $i;
            $this->excel->getActiveSheet()
                ->getStyle($range)
                ->getNumberFormat()
                ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            
            $fileName = 'ListaArticulosProveedor_' . $codEntidad . '.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $fileName);
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('php://output');
            exit();
        } else {
            show_404();
        }
    }

    public function getEntidad(){
        if($this->input->is_ajax_request()){
            if($this->session->userdata('logged_in')){
                $codEnt = $this->input->post('codEntidad');
                $item = $this->entidad_model->getEntidad(array('cod_entidad'=>$codEnt));
                echo json_encode($item);
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    // exporta estado de cuenta por edo cuenta
    function exportEdoCuentaCliente()
    {
        if ($this->session->userdata('logged_in')) {
            
            $data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            $desde = $this->uri->segment(4);
            $hasta = $this->uri->segment(5);
            
            $nombreCom = $data_session['nombre_completo'];
            
            $this->load->library('excel');
            $this->excel->getProperties()
                ->setCreator(utf8_encode($nombreCom))
                ->setLastModifiedBy(utf8_encode($nombreCom))
                ->setTitle(utf8_encode('Estado de cuenta por cliente'))
                ->setSubject(utf8_encode('Estado de cuenta por cliente'))
                ->setDescription(utf8_encode('Estado de cuenta por cliente'))
                ->setKeywords(utf8_encode('Estado de cuenta por cliente'))
                ->setCategory(utf8_encode('Estado de cuenta por cliente'));
            
            // titulos
            $this->excel->setActiveSheetIndex(0)->mergeCells('A1:F1');
            $this->excel->setActiveSheetIndex(0)->setCellValue('A1', utf8_encode('ESTADO DE CUENTA POR CLIENTE'));
            
            $objEntidad = $this->entidad_model->mostrar_entidad_id($idEntidad, array(
                'nombre_razon_social'
            ));
            
            $this->excel->setActiveSheetIndex(0)->mergeCells('A2:F2');
            $this->excel->setActiveSheetIndex(0)->setCellValue('A2', 'Cliente ' . $objEntidad->nombre_razon_social);
            
            // formato de columnas
            $this->excel->getActiveSheet()
                ->getStyle('A3:F3')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $this->excel->getActiveSheet()
                ->getStyle('A3:F3')
                ->getFill()
                ->getStartColor()
                ->setARGB('E5E1E1');
            $this->excel->getActiveSheet()
                ->getStyle("A3:F3")
                ->getFont()
                ->setBold(true);
            /*
             * $this->excel->getActiveSheet()
             * ->getColumnDimension('B')
             * ->setWidth(46.29);
             */
            $this->excel->setActiveSheetIndex(0)->setCellValue('A3', "FECHA");
            $this->excel->setActiveSheetIndex(0)->setCellValue('B3', "REMISION");
            $this->excel->setActiveSheetIndex(0)->setCellValue('C3', "DESCRIPCION");
            $this->excel->setActiveSheetIndex(0)->setCellValue('D3', "DEBE");
            $this->excel->setActiveSheetIndex(0)->setCellValue('E3', "HABER");
            $this->excel->setActiveSheetIndex(0)->setCellValue('F3', "SALDO");
            
            $dWhere = "DATE(ec.fecha) BETWEEN '$desde'
					AND '$hasta'
					AND ec.id_entidad = $idEntidad
				";
            
            // lista de pagos
            $items = $this->entidad_model->getListEdoCuentaEntidad($dWhere);
            
            $i = 4;
            $diasCred = 0;
            $saldo = 0;
            if ($items != NULL) {
                foreach ($items as $item) {
                    /*
                     * if($item['diasCredVig'] >= 0 && $item['diasCredVig']<= 5){
                     * $diasCred = $item['diasCredVig'];
                     * }else{
                     * if($item['diasCredVig']>=0){
                     * $diasCred = $item['diasCredVig'];
                     * }else{
                     * $diasCred = $item['diasCredVen'];
                     * }
                     * }
                     */
                    $saldo = $item['importe'];
                    if ($item['tipo'] == 'C') {
                        $debe = $item['importe'];
                        $haber = NULL;
                    } else {
                        $debe = NULL;
                        $haber = $item['importe'];
                    }
                    
                    $this->excel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['fecha']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, $item['n_doc']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('C' . $i, $item['tipo_movimiento'] . ' ' . $item['observaciones']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('D' . $i, $debe);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('E' . $i, $haber);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('F' . $i, $item['saldo_total']);
                    
                    $i ++;
                }
            } else {
                $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, 'No existen registros');
            }
            /*
             * $range = 'A1:A'.$i;
             * $this->excel->getActiveSheet()
             * ->getStyle($range)
             * ->getNumberFormat()
             * ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
             */
            $fileName = 'Estado_cuenta_x_cliente.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $fileName);
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('php://output');
            exit();
        } else {
            show_404();
        }
    }

    // exporta documentos por cliente pagos por metodo pago
    function exportDocumentosCliente()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            $nombreCom = $data_session['nombre_completo'];
            
            $this->load->library('excel');
            $this->excel->getProperties()
                ->setCreator(utf8_encode($nombreCom))
                ->setLastModifiedBy(utf8_encode($nombreCom))
                ->setTitle(utf8_encode('Estado de cuenta por cliente'))
                ->setSubject(utf8_encode('Estado de cuenta por cliente'))
                ->setDescription(utf8_encode('Estado de cuenta por cliente'))
                ->setKeywords(utf8_encode('Estado de cuenta por cliente'))
                ->setCategory(utf8_encode('Estado de cuenta por cliente'));
            
            // titulos
            $this->excel->setActiveSheetIndex(0)->mergeCells('A1:F1');
            $this->excel->setActiveSheetIndex(0)->setCellValue('A1', utf8_encode('ESTADO DE CUENTA POR CLIENTE'));
            
            $objEntidad = $this->entidad_model->mostrar_entidad_id($idEntidad, array(
                'nombre_razon_social'
            ));
            
            $this->excel->setActiveSheetIndex(0)->mergeCells('A2:F2');
            $this->excel->setActiveSheetIndex(0)->setCellValue('A2', 'Cliente ' . $objEntidad->nombre_razon_social);
            
            // formato de columnas
            $this->excel->getActiveSheet()
                ->getStyle('A3:F3')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $this->excel->getActiveSheet()
                ->getStyle('A3:F3')
                ->getFill()
                ->getStartColor()
                ->setARGB('E5E1E1');
            $this->excel->getActiveSheet()
                ->getStyle("A3:F3")
                ->getFont()
                ->setBold(true);
            /*
             * $this->excel->getActiveSheet()
             * ->getColumnDimension('B')
             * ->setWidth(46.29);
             */
            $this->excel->setActiveSheetIndex(0)->setCellValue('A3', "FECHA");
            $this->excel->setActiveSheetIndex(0)->setCellValue('B3', "REMISION");
            $this->excel->setActiveSheetIndex(0)->setCellValue('C3', "DESCRIPCION");
            $this->excel->setActiveSheetIndex(0)->setCellValue('D3', "DEBE");
            $this->excel->setActiveSheetIndex(0)->setCellValue('E3', "HABER");
            $this->excel->setActiveSheetIndex(0)->setCellValue('F3', "SALDO");
            
            $dataWhere = array(
                'pmp.id_entidad' => $idEntidad,
                'pmp.id_condiciones_pago' => 2
            );
            
            // lista de pagos
            $items = $this->pagos_model->listaPagosOrden($dataWhere);
            
            $i = 4;
            $diasCred = 0;
            if ($items != NULL) {
                foreach ($items as $item) {
                    /*
                     * if($item['diasCredVig'] >= 0 && $item['diasCredVig']<= 5){
                     * $diasCred = $item['diasCredVig'];
                     * }else{
                     * if($item['diasCredVig']>=0){
                     * $diasCred = $item['diasCredVig'];
                     * }else{
                     * $diasCred = $item['diasCredVen'];
                     * }
                     * }
                     */
                    $this->excel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['fecha']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, $item['serie'] . '-' . $item['folio']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('C' . $i, $item['tipo_movimiento']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('D' . $i, $item['saldo']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('E' . $i, $item['pagado']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('F' . $i, $item['saldo_total_entidad']);
                    
                    $i ++;
                }
            } else {
                $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, 'No existen registros');
            }
            /*
             * $range = 'A1:A'.$i;
             * $this->excel->getActiveSheet()
             * ->getStyle($range)
             * ->getNumberFormat()
             * ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
             */
            $fileName = 'Estado_cuenta_x_cliente.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $fileName);
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('php://output');
            exit();
        } else {
            show_404();
        }
    }

    // listado de clientes con saldo
    function listaClientesSaldo()
    {
        if ($this->input->is_ajax_request()) {
            $items = $this->entidad_model->getListaEntidadCri(array(
                'SALDO!=' => 0
            ), $cols = array(
                'id_entidad',
                'cod_entidad',
                'nombre_razon_social',
                'SALDO',
                'fec_ult_pag_cred'
            ));
            echo json_encode(array(
                'items' => $items
            ));
        } else {
            show_404();
        }
    }

    // exporta listado de clientes con saldo
    function exportClienteSaldos()
    {
        if ($this->session->userdata('logged_in')) {
            $data_session = $this->session->userdata('logged_in');
            
            $idEntidad = $this->uri->segment(3);
            $nombreCom = $data_session['nombre_completo'];
            
            $this->load->library('excel');
            $this->excel->getProperties()
                ->setCreator(utf8_encode($nombreCom))
                ->setLastModifiedBy(utf8_encode($nombreCom))
                ->setTitle(utf8_encode('Saldos Clientes'))
                ->setSubject(utf8_encode('Saldos Clientes'))
                ->setDescription(utf8_encode('Saldos Clientes'))
                ->setKeywords(utf8_encode('Saldos Clientes'))
                ->setCategory(utf8_encode('Saldos Clientes'));
            
            // formato de columnas
            $this->excel->getActiveSheet()
                ->getStyle('A1:C1')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $this->excel->getActiveSheet()
                ->getStyle('A1:C1')
                ->getFill()
                ->getStartColor()
                ->setARGB('E5E1E1');
            $this->excel->getActiveSheet()
                ->getStyle("A1:C1")
                ->getFont()
                ->setBold(true);
            /*
             * $this->excel->getActiveSheet()
             * ->getColumnDimension('B')
             * ->setWidth(46.29);
             */
            $this->excel->setActiveSheetIndex(0)->setCellValue('A1', "CLAVE");
            $this->excel->setActiveSheetIndex(0)->setCellValue('B1', "NOMBRE CLIENTE");
            $this->excel->setActiveSheetIndex(0)->setCellValue('C1', "SALDO");
            
            // extrayendo listado segun criterio
            $items = $this->entidad_model->getListaEntidadCri(array(
                'SALDO!=' => 0
            ), $cols = array(
                'id_entidad',
                'cod_entidad',
                'nombre_razon_social',
                'SALDO',
                'fec_ult_pag_cred'
            ));
            $i = 2;
            
            if ($items != NULL) {
                foreach ($items as $item) {
                    
                    $this->excel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['cod_entidad']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, $item['nombre_razon_social']);
                    $this->excel->setActiveSheetIndex(0)->setCellValue('C' . $i, number_format((double) $item['SALDO'], 2));
                    $i ++;
                }
            } else {
                $this->excel->setActiveSheetIndex(0)->setCellValue('B' . $i, 'No existen registros');
            }
            /*
             * $range = 'A1:A'.$i;
             * $this->excel->getActiveSheet()
             * ->getStyle($range)
             * ->getNumberFormat()
             * ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
             */
            $fileName = 'Saldos_clientes.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $fileName);
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('php://output');
            exit();
        } else {
            show_404();
        }
    }

    // valida si existe entidad por rfc
    function getEntidadByRFC()
    {
        if ($this->input->is_ajax_request()) {
            $rfc = $this->input->post('rfc');
            $tipo = $this->input->post('tipo');
            $dWhere = array(
                'rfc' => $rfc,
                'entidad_tipo' => $tipo
            );
            $dataR = $this->entidad_model->getEntidad($dWhere);
            $correos = '';
            $telefonos = '';
            
            if ($dataR != NULL) {
                $id_entidad = $dataR['id_entidad'];
                $list_correos = $this->entidad_model->obtener_lista_propiedad_correo($id_entidad);
                $list_telefonos = $this->entidad_model->obtener_lista_propiedad_telefono($id_entidad);
                foreach ($list_correos as $row_c) {
                    $correos .= $row_c['valor'] . ',';
                }
                foreach ($list_telefonos as $row_t) {
                    $telefonos .= $row_t['valor'] . ',';
                }
            }
            echo json_encode(array(
                'entidad' => $dataR,
                'correos' => $correos,
                'telefonos' => $telefonos
            ));
        } else {
            show_404();
        }
    }

    // recupera estado de cuenta por entidad
    function getEdoCuentaEntidad()
    {
        if ($this->input->is_ajax_request()) {
            
            $idEntidad = $this->input->post('idEntidad');
            $desde = $this->input->post('desde');
            $hasta = $this->input->post('hasta');
            
            if ($desde == '') {
                $desde = (new DateTime())->format('Ymd');
            } else {
                $desde = substr($desde, 6, 4) . substr($desde, 3, 2) . substr($desde, 0, 2);
            }
            
            if ($hasta == '') {
                $hasta = (new DateTime())->format('Ymd');
            } else {
                $hasta = substr($hasta, 6, 4) . substr($hasta, 3, 2) . substr($hasta, 0, 2);
            }
            
            $dWhere = "DATE(ec.fecha) BETWEEN '$desde'
					AND '$hasta'
					AND ec.id_entidad = $idEntidad
				";
            
            $items = $this->entidad_model->getEdoCuentaEntidad($dWhere);
            
            $entidad = $this->entidad_model->getEntidad(array(
                'id_entidad' => $idEntidad
            ), array(
                'dias_credito',
                'monto_credito',
                'SALDO'
            ));
            
            echo json_encode(array(
                'items' => $items,
                'entidad' => $entidad
            ));
        } else {
            show_404();
        }
    }

    // guarda ajuste en edo de cuenta
    function guardaAjusteEdoCuenta()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->session->userdata('logged_in')) {
                $data_session = $this->session->userdata('logged_in');
                $idUsuario = $data_session['id_usuario'];
                $tipoCaAb = $this->input->post('tipo');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    // recupera listado de tipos de estado de cuenta as
    function getTipoEdoCuenta()
    {
        if ($this->input->is_ajax_request()) {
            
            $tipo = $this->input->post('tipo');
            $idEntidad = $this->input->post('idEntidad');
            
            $itemsBancos = NULL;
            $itemsMp = NULL;
            $itemsNotas = NULL;
            $itemEntidad = NULL;
            $itemTipoMov = NULL;
            
            $dWhere = array(
                'tipo' => $tipo
            );
            
            // recuperando lista de bancos si es un abono y metodo de pago
            if ($tipo == 'A') {
                $itemsBancos = $this->catalogos_model->getBancos();
                $itemsMp = $this->catalogos_model->getListMetodoPago();
            } else if ($tipo == 'C') {
                // recupendado dias y credito disponible de la entidad
                $itemEntidad = $this->entidad_model->getEntidad(array(
                    'id_entidad' => $idEntidad
                ), array(
                    'dias_credito',
                    'monto_credito',
                    'SALDO'
                ));
                $saldoDis = ((double) $itemEntidad['monto_credito'] - (double) $itemEntidad['SALDO']);
                
                $itemEntidad = array(
                    'dias_credito' => $itemEntidad['dias_credito'],
                    'saldo' => $itemEntidad['SALDO'],
                    'monto_credito' => $itemEntidad['monto_credito'],
                    'saldo_dispo' => $saldoDis
                );
            }
            
            // recuperando notas o presupuestos para los cuales afecta el edo de cuenta
            /*
             * $dWhereDoc = array(
             * 'oc.id_entidad'=>$idEntidad,
             * 'oc.saldo >'=>0,
             * 'oc.id_tipo_comprobante!='=>1
             * );
             */
            
            $dWhereDoc = array(
                'ec.id_entidad' => $idEntidad,
                'ec.saldo >' => 0,
                'ec.fecha_vence !=' => NULL
            );
            
            // $itemsNotas = $this->entidad_model->getListDocEntidadJOIN($dWhereDoc);
            $itemsNotas = $this->entidad_model->getListEdoCuentaEntJOIN($dWhereDoc);
            
            $items = $this->catalogos_model->getTipoEdoCuenta($dWhere);
            
            // tipo de movimientos
            
            $itemTipoMov = $this->catalogos_model->getDesMov($dWhere);
            
            echo json_encode(array(
                'items' => $items,
                'itemsBancos' => $itemsBancos,
                'itemsMp' => $itemsMp,
                'itemsNotas' => $itemsNotas,
                'itemEntidad' => $itemEntidad,
                'itemTipoMov' => $itemTipoMov
            ));
        } else {}
    }

    // guarda abono
    function saveAbono()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->session->userdata('logged_in')) {
                
                $data_session = $this->session->userdata('logged_in');
                $idUsuario = $data_session['id_usuario'];
                $idTienda = $data_session['id_tienda'];
                
                // $idOrdenC = ($this->input->post('idOrdenC')!=0) ? $this->input->post('idOrdenC') : NULL;
                $idCargo = ($this->input->post('idCargo') != 0) ? $this->input->post('idCargo') : NULL;
                
                $idTipoEdoCuenta = $this->input->post('idTipoEdoCuenta');
                $tipo = $this->input->post('tipo');
                $fechaP = $this->input->post('fechaP');
                $fechaVence = ($this->input->post('fechaVence') != '') ? $this->input->post('fechaVence') : NULL;
                $importe = (double) $this->input->post('importe');
                $idEntidad = $this->input->post('idEntidad');
                $nDoc = ($this->input->post('nDoc') != '') ? strtoupper($this->input->post('nDoc')) : NULL;
                $idBanco = $this->input->post('idBanco');
                $idMetPago = ($this->input->post('idMetPago') != 0) ? $this->input->post('idMetPago') : NULL;
                $diasC = $this->input->post('diasC');
                $nDocAbono = ($this->input->post('nDocAbono') != '') ? $this->input->post('nDocAbono') : NULL;
                $saldoDoc = ($this->input->post('saldoDoc') != 0) ? $this->input->post('saldoDoc') : NULL;
                $conPago = ($this->input->post('conPago') != 0) ? $this->input->post('conPago') : NULL;
                $idMov = ($this->input->post('idMov') != 0) ? $this->input->post('idMov') : NULL;
                $desCargo = ($this->input->post('desCargo') != '') ? $this->input->post('desCargo') : NULL;
                
                $saldoDocN = NULL; // saldo por pagar del docto seleccionado unicamente
                $fechaVence = NULL; // vencimiento del docto
                $msg = 'Registro agregado correctamente'; // mensaje de salida
                $edo = TRUE; // var para validar errores de captura
                             
                // formateo de fecha
                $fechaP = substr($fechaP, 6, 4) . '-' . substr($fechaP, 3, 2) . '-' . substr($fechaP, 0, 2);
                
                // fecha servidor
                $nowDate = date('Y-m-d');
                
                // ****** VALIDACIONES
                // validando que la fecha de captura no sea mayor a la del servidor
                if (strtotime($fechaP) > strtotime($nowDate)) {
                    $edo = FALSE;
                    $msg = 'La fecha es mayor a la actual, favor de corregirla';
                }
                
                // validando que la fecha de captura no sea menor a dos a�os por dias
                $dateCap = date_create($fechaP);
                $dateNow = date_create($nowDate);
                
                $diff = date_diff($dateCap, $dateNow); // diferencia en dias
                $difeDias = $diff->format('%a'); // "%R%a days"
                
                if ($difeDias > 730) {
                    $edo = FALSE;
                    $msg = 'La fecha de captura es menor a dos anos, favor de corregirla';
                }
                // log_message('error', 'Edo ' . $edo);
                // entrando si se cumplieron las validaciones
                if ($edo) {
                    // bandera para pago unico por documento
                    $pagoPorDocto = TRUE;
                    
                    // afectando el saldo del cliente
                    $col;
                    if ($tipo == 'C') {
                        // cargo
                        
                        // credito del cliente
                        $col = 'SALDO + ' . $importe;
                    } else {
                        // abono
                        
                        // credito del cliente
                        $col = 'SALDO - ' . $importe;
                        
                        // si la orden viene de documento generado por G-PRO **** PENDIENTE
                        /*
                         * if($idOrdenC!=NULL){
                         * # actualizando saldos de orden_c
                         * $colOrden = 'saldo - ' . $importe;
                         * $colPag = 'total_pagado + ' . $importe;
                         * $this->orden_model->actualizaSadoOrden(array('id_orden_c'=>$idOrdenC), $colOrden, $colPag );
                         * }
                         */
                        if ($idCargo != NULL) {
                            // actualizando el saldo en el documento seleccionado
                            $colOrden = 'saldo - ' . $importe;
                            $colPag = 'total_pagado + ' . $importe;
                            $this->entidad_model->actualizaSadoEdoCienta(array(
                                'id_estado_cuenta_entidad' => $idCargo
                            ), $colOrden, $colPag);
                        } else {
                            // aplicando el total del abono a varios doctos
                            $this->aplicaPagDocCreditoConsigna($idTipoEdoCuenta, $fechaP, $idUsuario, $idEntidad, $idTienda, $idMetPago, $conPago, $idMov, $desCargo, $importe);
                            
                            $pagoPorDocto = FALSE;
                        }
                    }
                    
                    // actualiza el saldo en la tabla de cliente
                    $this->entidad_model->actualiza_credito($idEntidad, $col);
                    
                    // recuperando entidad
                    $enti = $this->entidad_model->getEntidad(array(
                        'id_entidad' => $idEntidad
                    ), array(
                        'SALDO'
                    ));
                    
                    // Si ya se aplico un pago a varios doctos no insertar nuevamente
                    if ($pagoPorDocto) {
                        // validando que el cargo no sea de documento con el campo $nDoc = NULL
                        if ($nDoc != NULL) {
                            
                            // calcualdo la fecha de vencimiento por los dias de credito
                            $fechaVence = $this->utilsfunc->addDayswithDate($fechaP, $diasC);
                            
                            $dInsert = array(
                                'id_tipo_estado_cuenta' => $idTipoEdoCuenta,
                                'tipo' => $tipo,
                                'fecha' => $fechaP,
                                'fecha_vence' => $fechaVence,
                                'importe' => $importe,
                                'id_usuario' => $idUsuario,
                                'id_entidad' => $idEntidad,
                                'id_tienda' => $idTienda,
                                'n_doc' => $nDoc,
                                'id_banco' => $idBanco,
                                'id_metodo_pago' => $idMetPago,
                                'saldo' => $importe,
                                'saldo_total' => $enti['SALDO'],
                                'total_pagado' => 0,
                                'id_condiciones_pago' => $conPago,
                                'id_tipo_mov' => $idMov,
                                'observaciones' => $desCargo
                            );
                        } else {
                            if ($saldoDoc != NULL) {
                                // si el abono va para un documento aplica el restante
                                $saldoDocN = $saldoDoc - $importe;
                            }
                            
                            $dInsert = array(
                                'id_tipo_estado_cuenta' => $idTipoEdoCuenta,
                                'tipo' => $tipo,
                                'fecha' => $fechaP,
                                'importe' => $importe,
                                'id_usuario' => $idUsuario,
                                'id_entidad' => $idEntidad,
                                'id_tienda' => $idTienda,
                                'id_banco' => $idBanco,
                                'id_metodo_pago' => $idMetPago,
                                'n_doc' => $nDocAbono,
                                'saldo' => $saldoDocN,
                                'saldo_total' => $enti['SALDO'],
                                'id_condiciones_pago' => $conPago,
                                'id_tipo_mov' => $idMov,
                                'observaciones' => $desCargo
                            );
                        }
                        // insertando edo de cuenta
                        $this->entidad_model->insertEstadoCuentaEntidad($dInsert);
                    } // end pagoPorDocto
                } // end validaciones
                
                echo json_encode(array(
                    'msg' => $msg,
                    'fechaVence' => $fechaVence,
                    'edo' => $edo
                ));
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    // funcion privada para aplicar varios doctos
    private function aplicaPagDocCreditoConsigna($idTipoEdoCuenta, $fechaP, $idUsuario, $idEntidad, $idTienda, $idMetPago, $conPago, $idMov, $desCargo, $importeAbono)
    {
        
        // recuperando entidad
        $enti = $this->entidad_model->getEntidad(array(
            'id_entidad' => $idEntidad
        ), array(
            'SALDO'
        ));
        
        $saldoEntidad = $enti['SALDO'];
        /*
         * $importeAbono = 1200
         * $saldoEntidad = 40,000
         *
         */
        $dWhere = array(
            'id_entidad' => $idEntidad,
            'fecha_vence !=' => NULL,
            'tipo' => 'C',
            'saldo>' => 0
        );
        $items = $this->entidad_model->getEdosCuentaEntidad($dWhere);
        
        $importe = 0;
        
        $dDataR = array();
        $dDataU = array();
        
        foreach ($items as $item) {
            
            $saldoDocN = $item['saldo'];
            $nDocAbono = $item['n_doc'];
            $totalPagado = $item['total_pagado'];
            $idEdoCuentaEntidad = $item['id_estado_cuenta_entidad'];
            
            if ($importeAbono == 0)
                break; // rompiendo ciclo por abono finalizado
            
            if ($importeAbono >= $saldoDocN) {
                $importeAbono = ($importeAbono - $saldoDocN);
                $importe = $saldoDocN;
                $saldoDocN = 0;
            } else {
                $saldoDocN = ($saldoDocN - $importeAbono);
                $importe = $importeAbono;
                $importeAbono = 0;
            }
            
            $saldoEntidad = ($saldoEntidad - $importe);
            
            if ($saldoEntidad == 0) {
                if ($saldoEntidad == 0) {
                    $saldoEntidad = ($importeAbono) * (- 1);
                }
            }
            
            $dInsert = array(
                'id_tipo_estado_cuenta' => $idTipoEdoCuenta,
                'tipo' => 'A',
                'fecha' => $fechaP,
                'importe' => $importe,
                'id_usuario' => $idUsuario,
                'id_entidad' => $idEntidad,
                'id_tienda' => $idTienda,
                'id_metodo_pago' => $idMetPago,
                'n_doc' => $nDocAbono,
                'saldo' => $saldoDocN,
                'saldo_total' => $saldoEntidad,
                'id_condiciones_pago' => $conPago,
                'id_tipo_mov' => $idMov,
                'observaciones' => $desCargo
            );
            
            $dUpdate = array(
                'saldo' => $saldoDocN,
                'total_pagado' => ($totalPagado + $importe),
                'id_estado_cuenta_entidad' => $idEdoCuentaEntidad
            );
            
            array_push($dDataR, $dInsert); // insert
            array_push($dDataU, $dUpdate); // update
        }
        // log_message('error', print_r($dDataR, TRUE));
        
        // insertando registos por cada pago
        $this->entidad_model->insertEstadosCuentaEntidad($dDataR);
        
        // actualizando documentos cols saldo
        $this->entidad_model->updateBatchEstadosCuentaEntidad($dDataU);
    }

    function cambiaFechaDocto() {
        if ($this->input->is_ajax_request()) {
            
            $id = $this->input->post('id');
            $fecha = $this->input->post('fecha');
            
            $fecha = substr($fecha, 6, 4) . '-' . substr($fecha, 3, 2) . '-' . substr($fecha, 0, 2);
            
            $dData = array(
                'fecha' => $fecha
            );
            
            $dWhere = array(
                'id_estado_cuenta_entidad' => $id
            );
            
            $this->entidad_model->updateEdoCuentaEnti($dData, $dWhere);
            
            echo json_encode(array(
                'msg' => 'Registro editado correctamentne'
            ));
        } else {
            show_404();
        }
    }
    
}
?>