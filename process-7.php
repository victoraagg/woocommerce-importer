<?php
$attr_1 = array();
$attr_2 = array();

if($value[$data_index['DIFERENCIACION_1']]!=NULL){
    array_push( $attr_1,trim($value[$data_index['DIFERENCIACION_1']]) );
}
if($value[$data_index['DIFERENCIACION_2']]!=NULL){
    array_push( $attr_2,trim($value[$data_index['DIFERENCIACION_2']]) );
}

$filter_1 = ucfirst(strtolower($value[$data_index['FILTRO_AMBITO_USO']]));
$filter_2 = ucfirst(strtolower($value[$data_index['FILTRO_COLECCION']]));
$filter_3 = ucfirst(strtolower($value[$data_index['FILTRO_AHORRO_AGUA']]));
$filter_4 = ucfirst(strtolower($value[$data_index['FILTRO_INSTALACION']]));
$filter_5 = ucfirst(strtolower($value[$data_index['FILTRO_MEZCLA_AGUA']]));
$filter_6 = ucfirst(strtolower($value[$data_index['FILTRO_CERTIFICACION']]));