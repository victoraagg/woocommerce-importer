<?php
//Add QUOTA image:
if($value[$data_index['IMAGEN_COTAS']]){
    $url = get_site_url().'/wp-content/uploads/'.date('Y').'/'.date('m').'/'.$value[$data_index['IMAGEN_COTAS']];
    add_post_meta( $post_id, '_quota_image', $url );
}