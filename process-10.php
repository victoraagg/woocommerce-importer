<?php
if($value[$data_index['DIFERENCIACION_1']]!=NULL && !in_array($value[$data_index['DIFERENCIACION_1']],$attr_1)){
    array_push( $attr_1,trim($value[$data_index['DIFERENCIACION_1']]) );
}
if($value[$data_index['DIFERENCIACION_2']]!=NULL && !in_array($value[$data_index['DIFERENCIACION_2']],$attr_2)){
    array_push( $attr_2,trim($value[$data_index['DIFERENCIACION_2']]) );
}