<?php
//################### Add attributes to main product: #############################
wp_set_object_terms($post_parent_id, $filter_1, 'pa_ambito-de-uso');
wp_set_object_terms($post_parent_id, $filter_2, 'pa_coleccion');
wp_set_object_terms($post_parent_id, $filter_3, 'pa_ahorro-de-agua');
wp_set_object_terms($post_parent_id, $filter_4, 'pa_tipo-de-instalacion');
wp_set_object_terms($post_parent_id, $filter_5, 'pa_mezcla-de-agua');
wp_set_object_terms($post_parent_id, $filter_6, 'pa_certificado');

$attr_data = Array(
    'pa_diferenciacion-1'=> Array(
        'name'=> 'pa_diferenciacion-1',
        'value'=> implode('|',$attr_1),
        'is_visible' => (!empty($attr_1)) ? '0' : '0', 
        'is_variation' => (!empty($attr_1)) ? '1' : '0',
        'is_taxonomy' => '0'
    ),
    'pa_diferenciacion-2'=> Array(
        'name'=> 'pa_diferenciacion-2',
        'value'=> implode('|',$attr_2),
        'is_visible' => (!empty($attr_2)) ? '0' : '0', 
        'is_variation' => (!empty($attr_2)) ? '1' : '0',
        'is_taxonomy' => '0'
    ),
    'pa_ambito-de-uso'=> Array(
        'name'=> 'pa_ambito-de-uso',
        'value'=> $filter_1,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    ),
    'pa_familia'=> Array(
        'name'=> 'pa_coleccion',
        'value'=> $filter_2,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    ),
    'pa_ahorro-de-agua'=> Array(
        'name'=> 'pa_ahorro-de-agua',
        'value'=> $filter_3,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    ),
    'pa_tipo-de-instalacion'=> Array(
        'name'=> 'pa_tipo-de-instalacion',
        'value'=> $filter_4,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    ),
    'pa_mezcla-de-agua'=> Array(
        'name'=> 'pa_mezcla-de-agua',
        'value'=> $filter_5,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    ),
    'pa_certificado'=> Array(
        'name'=> 'pa_certificado',
        'value'=> $filter_6,
        'is_visible' => '1', 
        'is_variation' => '0',
        'is_taxonomy' => '1'
    )
);
add_post_meta( $post_parent_id,'_product_attributes',$attr_data );
//########################## Done adding attributes to product #############################