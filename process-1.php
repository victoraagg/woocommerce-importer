<?php
//Add product info:

$post = array(
    'post_title'   => $value[$data_index['NOMBRE']],
    'post_content' => $value[$data_index['CARACTERISTICAS']] == NULL ? '' : $value[$data_index['CARACTERISTICAS']],
    'post_status'  => "publish",
    'post_excerpt' => $value[$data_index['DESCRIPCION']],
    //'post_name'    => "", //name/slug (Autogenerate)
    'post_type'    => "product"
);

//Create product/post:
$post_id = wp_insert_post( $post );
$post_parent_id = $post_id;
$product_name_to_check_variation = trim($value[$data_index['NOMBRE']]);

//Append product info to log
$logtxt .= "Product_ID :". $post_id ." - SKU: ".$value[$data_index['REFERENCIA']]."\n";

//make product type be SIMPLE/VARIABLE (in lowercase):
wp_set_object_terms($post_id,'variable','product_type');

//add category to product:
wp_set_object_terms($post_id, $value[$data_index['FILTRO_FAMILIA']], 'product_cat');

$related_skus = array();
array_push($related_skus,$value[$data_index['REF_RELACIONADA_1']]);
array_push($related_skus,$value[$data_index['REF_RELACIONADA_2']]);
array_push($related_skus,$value[$data_index['REF_RELACIONADA_3']]);
array_push($related_skus,$value[$data_index['REF_RELACIONADA_4']]);
$related_skus = implode(',',$related_skus);

//set product values:
add_post_meta( $post_id, '_stock_status', 'instock');
add_post_meta( $post_id, '_visibility', 'visible' );
add_post_meta( $post_id, '_referenced_project_list', '' );
add_post_meta( $post_id, '_cross_sell_ids', $related_skus );