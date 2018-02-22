<?php
//###################### Add Variations post types #############################

$variation_post = array(
    'post_title'=> 'Variation #' . $key . ' for product #'. $post_parent_id,
    'post_name' => 'product-' . $post_parent_id . '-variation-' . $key,
    'post_status' => 'publish',
    'post_parent' => $post_parent_id, //post is a child post of product post
    'post_type' => 'product_variation', //set post type to product_variation
    'guid'=> home_url().'/?product_variation=product-' . $post_parent_id . '-variation-' . $key
);

//Insert post/variation into database:
$variation_id = wp_insert_post($variation_post);

//Create variation for product_variation:
if(!empty($attr_1)){
    update_post_meta( $variation_id, 'attribute_pa_diferenciacion-1', trim($value[$data_index['DIFERENCIACION_1']]) );
}
if(!empty($attr_2)){
    update_post_meta( $variation_id, 'attribute_pa_diferenciacion-2', trim($value[$data_index['DIFERENCIACION_2']]) );
}
update_post_meta($variation_id, '_sku', $value[$data_index['REFERENCIA']]);

//############################ Done adding variation posts ############################