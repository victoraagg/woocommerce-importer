<?php
//Add HQ image:
if($value[$data_index['IMAGEN_ALTA']]){
    $url = get_site_url().'/wp-content/uploads/'.date('Y').'/'.date('m').'/'.$value[$data_index['IMAGEN_ALTA']];
    add_post_meta( $post_id, '_hq_image', $url );
}
