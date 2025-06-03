<?php defined('BASEPATH') OR exit('No direct script access allowed');
    function paginationPage($tabla_, $pagina, $porPagina, $cols_, $dWhere = array(), $likeField, $likeMatch){
        
        $CI = get_instance();
        $CI->load->model('catalogos_model');

        if(!isset($porPagina)){
            $porPagina = 20;
        }
        
        if(!isset($pagina)){
            $pagina = 1;
        }

        $cuantos = $CI->catalogos_model->getSimprCountPagination($tabla_, $dWhere, $likeField, $likeMatch); // registros en la db
        $totalPag = ceil($cuantos / $porPagina); // redondeando para tener total de pag

        if($pagina > $totalPag){
            $pagina = $totalPag;
        }
        
        $pagina -= 1;
        $desde = ($pagina * $porPagina);

        // paguina siguiente
        if($pagina >= ($totalPag - 1) ){
            $pagSiguiente = 1;
        }else{
            $pagSiguiente = ($pagina + 2);
        }

        // pagina anterior
        if($pagina < 1){
            $pagAnterior = $totalPag;
        }else{
            $pagAnterior = $pagina;
        }
        
        // valores para el query
        $queryProps = array(
            'cols'=> $cols_,
            'table'=> $tabla_,
            'porPagina'=>$porPagina,
            'desde'=>$desde
        );
        
        $items = $CI->catalogos_model->getSimpleTablePagination($queryProps, $dWhere, $likeField, $likeMatch);

        $res = array(
            'cuantos'=>$cuantos,
            'totalPag'=>$totalPag,
            'pagActual'=>($pagina + 1),
            'pagSiguiente'=>$pagSiguiente,
            'pagAnterior'=>$pagAnterior,
            'items'=>$items
        );

        return $res;
    }
?>