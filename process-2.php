<?php
//Add featured image:
$attachment_id = attach_image($value[$data_index['IMAGEN_1']], $value[$data_index['NOMBRE']], $post_id);
if($attachment_id){
    add_post_meta($post_id, '_thumbnail_id', $attachment_id); 
}

//Add gallery images:
$ids = array();
$images = array();
if($value[$data_index['IMAGEN_GALERIA_1']]){
    $images[] = array(
        'url' => $value[$data_index['IMAGEN_GALERIA_1']],
        'alt' => $value[$data_index['NOMBRE']]
    );
}
if($value[$data_index['IMAGEN_GALERIA_2']]){
    $images[] = array(
        'url' => $value[$data_index['IMAGEN_GALERIA_2']],
        'alt' => $value[$data_index['NOMBRE']]
    );
}
if($value[$data_index['IMAGEN_GALERIA_3']]){
    $images[] = array(
        'url' => $value[$data_index['IMAGEN_GALERIA_3']],
        'alt' => $value[$data_index['NOMBRE']]
    );
}
foreach ($images as $image) {
    $destination = WP_CONTENT_DIR . '/uploads/'.date('Y').'/'.date('m').'/' . $image['url'];
    if(file_exists($destination)){
        $ids[] = attach_image($image['url'], $image['alt'], $post_id);
    }
}
add_post_meta($post_id, '_product_image_gallery', implode(',', $ids)); 