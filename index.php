<?php
/**
 * Plugin Name: Woocommerce Insert Products
 * Description: Add a simple/variable products to WP. Errors are written to wp-admin/insert_product_logs.txt file.
 * Version: 1.0.0
 * Author: Víctor Alonso
 * License: GPL2
 * Created On: 01-01-2018
 * Reference: https://ryanknights.co.uk/insert-woocommerce-products-variations-programmatically/
 * Reference: https://ryanknights.co.uk/insert-product-variation-gallery-images-programatically-into-woocommerce/
 */

function custom_wc_import() {
    add_menu_page(
        'WC Import',
        'WC Import', 
        'manage_options', 
        'custom-wc-import', 
        'custom_wc_import_edit', 
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'custom_wc_import');

function custom_wc_import_edit() {

    if (!current_user_can('manage_options')) {
        wp_die(__('Insufficient permissions'));
    }

    $hidden_field_name = 'options_hidden';

    if (isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y') {
        add_product();
        ?>
        <div class="updated"><p>Done</p></div>
    <?php } ?>
    <div class="wrap">
        <h2>Custom WooCommerce import</h2>
        <form name="wc-import" method="post" action="">
            <input type="hidden" name="<?= $hidden_field_name; ?>" value="Y">
            <input type="submit" name="submit" class="button-primary" value="Start import" />
        </form>
    </div>
    <?php
}

include( plugin_dir_path( __FILE__ ) . 'csv-convert.php');

function add_product() {

    $csv = csv_to_array('data.csv', ";", 40);
    include( plugin_dir_path( __FILE__ ) . 'array-csv.php');
    include( plugin_dir_path( __FILE__ ) . 'attach-image.php');
    $logtxt = "";
    $product_name_to_check_variation = "";
    $post_parent_id = 0;
    $attr_1 = array();
    $attr_2 = array();
    $filter_1 = "";
    $filter_2 = "";
    $filter_3 = "";
    $filter_4 = "";
    $filter_5 = "";
    $filter_6 = "";
    $last_element_csv = end($csv);

    foreach($csv as $key => $value){

        if($key > 0){

            if(trim($value[$data_index['NOMBRE']]) != $product_name_to_check_variation){
                if($key > 1){
                    //Insert attributes
                    include(plugin_dir_path( __FILE__ ) . 'process-9.php');
                }
                //Basic info
                include(plugin_dir_path( __FILE__ ) . 'process-1.php');
                //Featured
                include(plugin_dir_path( __FILE__ ) . 'process-2.php');
                //HQ image
                include(plugin_dir_path( __FILE__ ) . 'process-4.php');
                //Quota image
                include(plugin_dir_path( __FILE__ ) . 'process-5.php');
                //Certificates
                include(plugin_dir_path( __FILE__ ) . 'process-6.php');
                //Push first atributes values to array
                include(plugin_dir_path( __FILE__ ) . 'process-7.php');
                //Create variation
                include(plugin_dir_path( __FILE__ ) . 'process-8.php');
            }else{
                //Push more atributes values to array
                include(plugin_dir_path( __FILE__ ) . 'process-10.php');
                //Create variation
                include(plugin_dir_path( __FILE__ ) . 'process-8.php');
                if($value == $last_element_csv) {
                    //Insert attributes
                    include(plugin_dir_path( __FILE__ ) . 'process-9.php');
                }
            }
            
        }  

    }

    //file shows up in wp-admin folder
    $fh2 = fopen("wc_insert_product_logs".date('Y-m-d:H-i-s').".txt", 'a') or die("can't open log file to append");
    fwrite($fh2, $logtxt);
    fclose($fh2);

}