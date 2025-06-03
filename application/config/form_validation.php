<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');
    /*
     * Archivo de validacion de formularios
     */
    $config = array(
        'usuario_veryfi'=>array(
            array( 'field'=>'idKey', 'label'=>'key','rules'=>'trim|required'),
            array( 'field'=>'login-username', 'label'=>'Username','rules'=>'trim|required|xss_clean'),
            array( 'field'=>'login-password1', 'label'=>'Password','rules'=>'trim|required|xss_clean')
        ),
        'usuario_get'=>array(
            array( 'field'=>'login-username', 'label'=>'Username','rules'=>'trim|required|xss_clean'),
            array( 'field'=>'login-password1', 'label'=>'Password','rules'=>'trim|required|xss_clean|callback_check_database')
        ),
    	'pagination_helper' => array(
    		array('field'=>'idKey', 'label'=>'key','rules'=>'trim|required'),
    	    array('field'=>'likeField', 'label'=>'nombre de la colunma','rules'=>'trim|required'),
    	    array('field'=>'likeMatch', 'label'=>'valor de la columna','rules'=>'trim'),
    	    array('field'=>'pagina', 'label'=>'pagina','rules'=>'required'),
    	    array('field'=>'porPagina', 'label'=>'porPagina','rules'=>'required')
    	),
        'cancelMovCaja_post'=>array(
            array('field'=>'idVentaC', 'label'=>'campo cabecero','rules'=>'trim|required'),
            array('field'=>'idKey', 'label'=>'key','rules'=>'trim|required'),
            array('field'=>'idUsuario', 'label'=>'usuario','rules'=>'trim|required'),
            array('field'=>'observaciones', 'label'=>'observaciones','rules'=>'trim|required')
        ),
        'setCambioCosto_post'=>array(
            array('field'=>'idArticulo', 'label'=>'cod Articulo','rules'=>'trim|required'),
            array('field'=>'idUsuario', 'label'=>'usuario','rules'=>'trim|required'),
            array('field'=>'costoArt', 'label'=>'Costo','rules'=>'trim|required'),
            array('field'=>'idKey', 'label'=>'key','rules'=>'trim|required'),
            array('field'=>'idTienda', 'label'=>'Tienda','rules'=>'trim|required'),
            array('field'=>'observaciones', 'label'=>'Observaciones','rules'=>'trim|required')
        ),
        'getArticuloMaster_post'=>array(
            array('field'=>'claveArticulo', 'label'=>'Clave Articulo','rules'=>'trim|required')
        ),
        'getlistaCompra_post'=>array(
            array('field'=>'idTipoComprobante', 'label'=>'Tipo Comprobante','rules'=>'trim|required|numeric'),
            array('field'=>'idTienda', 'label'=>'Tienda','rules'=>'trim|required|numeric')
        ),
        'usuario_model' => array(
            array('field'=>'idTipoComprobante', 'label'=>'Tipo Comprobante','rules'=>'trim|required|numeric'),
            array('field'=>'idTienda', 'label'=>'Tienda','rules'=>'trim|required|numeric')
        ),
        'get_usuario' => array(
            array('field'=>'idUsuario', 'label'=>'Cod Usuario','rules'=>'trim|required|numeric')
        ),
        'validatePassword_post' => array(
            array('field'=>'idUsuario', 'label'=>'Cod Usuario','rules'=>'trim|required|numeric'),
            array('field'=>'password', 'label'=>'Contraseña','rules'=>'trim|required')
        ),
        'usuario_save' => array(
            array('field'=>'idUsuario', 'label'=>'Cod Usuario','rules'=>'trim|required|numeric'),
            array('field'=>'idTienda', 'label'=>'Tienda','rules'=>'trim|required|numeric'),
            array('field'=>'usuario', 'label'=>'Usuario','rules'=>'trim|required'),
            array('field'=>'nombreCompleto', 'label'=>'Nombre Completo','rules'=>'trim|required'),
        ),
        'get_entidad_by_id' => array(
            array('field'=>'idEntidad', 'label'=>'Cod Entida','rules'=>'trim|required|numeric')
        ),
        'set_entidad' => array(
            array('field'=>'nombre_razon_social', 'label'=>'Nombre Razon Social','rules'=>'trim|required'),
            array('field'=>'id_entidad', 'label'=>'Id','rules'=>'trim|required|numeric')
        ),
        'send_email' => array(
            array('field'=>'txtObservaciones', 'label'=>'Observaciones ','rules'=>'trim|required'),
            array('field'=>'urlFile', 'label'=>'Path archivo','rules'=>'trim|required'),
        ),
        'saveDireccionEntidad_post' => array(
            array('field'=>'', 'label'=>'Calle ','rules'=>'trim|required'),
            
        ),
        'getReporteAuxiliar_post' => array(
            array('field'=>'desde', 'label'=>'Desde ','rules'=>'trim'),
            array('field'=>'hasta', 'label'=>'Hasta ','rules'=>'trim'),
            array('field'=>'idEntidad', 'label'=>'Clave entidad ','rules'=>'trim|required|numeric')
        ),
        'getVentasPorVendedor_post' => array(
            array('field'=>'txtDesde', 'label'=>'Desde ','rules'=>'trim'),
            array('field'=>'txtHasta', 'label'=>'Hasta ','rules'=>'trim')
        ),
        'getVentasPorDocumento_post' => array(
            array('field'=>'txtDesde', 'label'=>'Desde ','rules'=>'trim'),
            array('field'=>'txtHasta', 'label'=>'Hasta ','rules'=>'trim')
        ),
        'saveFamilia_post' => array(
            array('field'=>'familia', 'label'=>'familia ','rules'=>'trim|required'),
            array('field'=>'idFamilia', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteFamilia_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idFamilia', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'saveLinea_post' => array(
            array('field'=>'linea', 'label'=>'linea ','rules'=>'trim|required'),
            array('field'=>'idLinea', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteLinea_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idLinea', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'saveSubLinea_post' => array(
            array('field'=>'sublinea', 'label'=>'Sublinea ','rules'=>'trim|required'),
            array('field'=>'idSubLinea', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteSubLinea_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idSubLinea', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'saveMarca_post' => array(
            array('field'=>'marca', 'label'=>'marca ','rules'=>'trim|required'),
            array('field'=>'idMarca', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteMarca_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idMarca', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'saveColor_post' => array(
            array('field'=>'color', 'label'=>'color ','rules'=>'trim|required'),
            array('field'=>'idColor', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteColor_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idColor', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'saveMedida_post' => array(
            array('field'=>'medida', 'label'=>'color ','rules'=>'trim|required'),
            array('field'=>'idMedida', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'deleteMedida_post' => array(
            array('field'=>'observacion', 'label'=>'observacion ','rules'=>'trim|required'),
            array('field'=>'idMedida', 'label'=>'id ','rules'=>'trim|required|numeric'),
        ),
        'getSelect_post' => array(
            array('field'=>'search', 'label'=>'observacion ','rules'=>'trim|required')
        ),
        'getProdSerSat_post' => array(
            array('field'=>'claveSat', 'label'=>'claveSat ','rules'=>'trim|required')
        ),
        'saveProdSerSat_post' => array(
            array('field'=>'claveSat', 'label'=>'claveSat ','rules'=>'trim|required'),
            array('field'=>'prodServi', 'label'=>'prodServi ','rules'=>'trim|required'),
        ),
        'exportKardex_post' => array(
            array('field'=>'claveArticulo', 'label'=>'producto servicio ','rules'=>'trim|required'),
            array('field'=>'formato', 'label'=>'formato ','rules'=>'trim|required'),
            array('field'=>'desde', 'label'=>'desde ','rules'=>'trim'),
            array('field'=>'hasta', 'label'=>'desde ','rules'=>'trim')
        ),
        'validaIniciales_post' => array(
            array('field'=>'inicialesUsuario', 'label'=>'iniciales ','rules'=>'trim|required|max_length[5]')
        ),
        'getListaCliente_post' => array(
            array('field'=>'codEntidad', 'label'=>'Cod Entidad ','rules'=>'trim|required')
        ),
        'deleteItemListaPrecio_post' => array(
            array('field'=>'idArticuloCliente', 'label'=>'Id','rules'=>'trim|required|numeric')
        ),
        'getReporteDocumento_post' => array(
            array('field'=>'txtDesde', 'label'=>'Desde ','rules'=>'trim'),
            array('field'=>'txtHasta', 'label'=>'Hasta ','rules'=>'trim'),
            array('field'=>'idTipoComprobante', 'label'=>'Id tipo Comprobante','rules'=>'trim|required|numeric')
        ),
        'getComprobantes_post' => array(
            array('field'=>'nombreArchivo', 'label'=>'nombreArchivo ','rules'=>'trim|required'),
            array('field'=>'path', 'label'=>'path ','rules'=>'trim|required'),
            array('field'=>'rfcTienda', 'label'=>'rfcTienda ','rules'=>'trim|required')
        )
    );
?>