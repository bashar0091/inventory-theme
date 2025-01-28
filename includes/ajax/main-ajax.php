<?php

// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

/** 
 * 
 * Page switch Handler
 * 
 */
function submission_form_handler()
{
    $company_name = isset($_POST['company_name']) ? sanitize_text_field($_POST['company_name']) : '';
    $items_name = isset($_POST['items_name']) ? sanitize_text_field($_POST['items_name']) : '';
    $quantity = isset($_POST['quantity']) ? sanitize_text_field($_POST['quantity']) : '';
    $rmb_cost = isset($_POST['rmb_cost']) ? sanitize_text_field($_POST['rmb_cost']) : '';
    $cnf_cost = isset($_POST['cnf_cost']) ? sanitize_text_field($_POST['cnf_cost']) : '';
    $price_taka = isset($_POST['price_taka']) ? sanitize_text_field($_POST['price_taka']) : '';
    $cost_type = isset($_POST['cost_type']) ? sanitize_text_field($_POST['cost_type']) : '';

    $uploaded_images = [];

    if (!empty($_FILES['product_images'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        foreach ($_FILES['product_images']['name'] as $key => $value) {
            if ($_FILES['product_images']['error'][$key] === UPLOAD_ERR_OK) {
                $file_name = sanitize_file_name($_FILES['product_images']['name'][$key]);
                $file_tmp = $_FILES['product_images']['tmp_name'][$key];
                $file_type = $_FILES['product_images']['type'][$key];

                if (strpos($file_type, 'image/') === 0 || $file_type === 'application/pdf') {
                    $upload_dir = wp_upload_dir();
                    $upload_path = $upload_dir['path'] . '/' . $file_name;

                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        $attachment = array(
                            'guid'           => $upload_dir['url'] . '/' . $file_name,
                            'post_mime_type' => $file_type,
                            'post_title'     => sanitize_file_name(pathinfo($file_name, PATHINFO_FILENAME)),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        );

                        $attach_id = wp_insert_attachment($attachment, $upload_path);
                        $attach_data = wp_generate_attachment_metadata($attach_id, $upload_path);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                        $uploaded_images[] = [
                            'url' => $upload_dir['url'] . '/' . $file_name,
                            'id'  => $attach_id
                        ];
                    }
                }
            }
        }
    }

    $product_data = array(
        'post_title'    => $items_name,
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'inventory-products',
    );

    $post_id = wp_insert_post($product_data);

    if ($post_id) {
        update_post_meta($post_id, 'name_of_company', $company_name);
        update_post_meta($post_id, 'name_of_items', $items_name);
        update_post_meta($post_id, 'quantity', $quantity);
        update_post_meta($post_id, 'cost_in_rmb', $rmb_cost);
        update_post_meta($post_id, 'cnf_cost', $cnf_cost);
        update_post_meta($post_id, 'total_price_in_tk', $price_taka);
        update_post_meta($post_id, 'cost_type', $cost_type);
        if (!empty($uploaded_images)) {
            update_post_meta($post_id, 'product_images', json_encode($uploaded_images));
        }
        wp_send_json_success(['success' => true, 'cost_type' => $cost_type]);
    }

    wp_die();
}
add_action('wp_ajax_submission_form_handler', 'submission_form_handler');
add_action('wp_ajax_nopriv_submission_form_handler', 'submission_form_handler');


/** 
 * 
 * sell_submission_form_handler
 * 
 */
function sell_submission_form_handler()
{
    $product_item = isset($_POST['product_item']) ? sanitize_text_field($_POST['product_item']) : '';
    $quantity = isset($_POST['quantity']) ? sanitize_text_field($_POST['quantity']) : '';
    $price_taka = isset($_POST['price_taka']) ? sanitize_text_field($_POST['price_taka']) : '';

    $sell_data = array(
        'post_title'    => 'Sell Item No ' . time(),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'inventory-sell',
    );
    $sell_id = wp_insert_post($sell_data);
    if ($sell_id) {
        update_post_meta($sell_id, 'product_item', $product_item);
        update_post_meta($sell_id, 'quantity', $quantity);
        update_post_meta($sell_id, 'price_taka', $price_taka);

        $adjust_item = get_post_meta($product_item, 'quantity', true);
        $adjust_amount = $adjust_item - $quantity;
        update_post_meta($product_item, 'quantity', $adjust_amount);

        wp_send_json_success(['success' => true, 'cost_type' => 'sell']);
    }
    wp_die();
}
add_action('wp_ajax_sell_submission_form_handler', 'sell_submission_form_handler');
add_action('wp_ajax_nopriv_sell_submission_form_handler', 'sell_submission_form_handler');


/** 
 * 
 * login_submission_form_handler
 * 
 */
function login_submission_form_handler()
{
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $credentials = [
        'user_login'    => $user,
        'user_password' => $password,
    ];
    $user = wp_signon($credentials, false);
    if (is_wp_error($user)) {
        wp_send_json_error(['message' => $user->get_error_message()]);
    } else {
        wp_send_json_success(['success' => true, 'cost_type' => 'login']);
    }
    wp_die();
}
add_action('wp_ajax_login_submission_form_handler', 'login_submission_form_handler');
add_action('wp_ajax_nopriv_login_submission_form_handler', 'login_submission_form_handler');


/** 
 * 
 * delete_table_record_handler
 * 
 */
function delete_table_record_handler()
{
    $productid = isset($_POST['productid']) ? $_POST['productid'] : '';
    $media = isset($_POST['media']) ? $_POST['media'] : '';
    $arraymedia = explode(',', $media);

    foreach ($arraymedia as $media_id) {
        $media_id = intval($media_id);
        if ($media_id > 0) {
            wp_delete_attachment($media_id, true);
        }
    }

    wp_delete_post($productid, true);

    wp_send_json_success(['delete' => 'istrue']);

    wp_die();
}
add_action('wp_ajax_delete_table_record_handler', 'delete_table_record_handler');
add_action('wp_ajax_nopriv_delete_table_record_handler', 'delete_table_record_handler');
