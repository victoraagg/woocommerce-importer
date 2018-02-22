<?php
require(ABSPATH . 'wp-load.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');

global $wpdb; 

function attach_image ($fileurl, $filealt, $post_id)  
{
    $filename = basename($fileurl); // Get the filename including extension from the $fileurl e.g. myimage.jpg
    $destination = WP_CONTENT_DIR . '/uploads/'.date('Y').'/'.date('m').'/' . $filename; // Specify where we wish to upload the file, generally in the wp uploads directory
    $filetype = wp_check_filetype($destination); // Get the mime type of the file
    if(file_exists($destination)){

        $attachment = array( // Set up our images post data
            'guid' => get_option('siteurl') . '/wp-content/uploads/'.date('Y').'/'.date('m').'/'.$filename, 
            'post_mime_type' => $filetype['type'],
            'post_title' => $filename,
            'post_author' => 1,
            'post_content' => ''
        );
        $attach_id = wp_insert_attachment( $attachment, $destination, $post_id ); // Attach/upload image to the specified post id, think of this as adding a new post.
        $attach_data = wp_generate_attachment_metadata( $attach_id, $destination ); // Generate the necessary attachment data, filesize, height, width etc.
        wp_update_attachment_metadata( $attach_id, $attach_data ); // Add the above meta data data to our new image post
        add_post_meta($attach_id, '_wp_attachment_image_alt', $filealt); // Add the alt text to our new image post
        return $attach_id; // Return the images id to use in the below functions

    }else{
        return false;
    }

}