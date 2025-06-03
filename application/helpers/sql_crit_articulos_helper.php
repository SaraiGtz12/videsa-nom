<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
function criteWhereArticulos($dReque) {
    $dWhere = '';
    $x = 0;
    foreach ($dReque as $key => $value) {
        
        switch ($key) {
            case 'txtBusCodArt':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "ar.claveArticulo = '$value'";
                        $x ++;
                }
                break;
            case 'txtBusDesArt':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "ar.articulo like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtBusItemArt':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "ar.item like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtBusFam':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "fa.familia like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtBusLin':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "li.linea like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtBusSubLi':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "su.sublinea like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtMarca':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "ma.marca like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtColor':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "co.color like '%$value%'";
                        $x ++;
                }
                break;
            case 'txtMed':
                if ($value != '') {
                    if ($x > 0)
                        $dWhere .= ' AND ';
                        $dWhere .= "me.medida like '%$value%'";
                        $x ++;
                }
                break;
        }
    }
    return $dWhere;
}