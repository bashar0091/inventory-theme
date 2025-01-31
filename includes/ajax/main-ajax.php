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

    $uploaded_images = handle_product_images_upload('product_images');

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
 * quotation_submission_form_handler
 * 
 */
function quotation_submission_form_handler()
{
    $quotation_title = isset($_POST['quotation_title']) ? sanitize_text_field($_POST['quotation_title']) : '';
    $currency = isset($_POST['currency']) ? sanitize_text_field($_POST['currency']) : '';

    $billing_from = isset($_POST['billing_from']) ? sanitize_text_field($_POST['billing_from']) : '';
    $billing_email = isset($_POST['billing_email']) ? sanitize_email($_POST['billing_email']) : '';
    $billing_phone = isset($_POST['billing_phone']) ? sanitize_text_field($_POST['billing_phone']) : '';
    $billing_address = isset($_POST['billing_address']) ? sanitize_text_field($_POST['billing_address']) : '';

    $billing_to = isset($_POST['billing_to']) ? sanitize_text_field($_POST['billing_to']) : '';
    $to_email = isset($_POST['to_email']) ? sanitize_email($_POST['to_email']) : '';
    $to_phone = isset($_POST['to_phone']) ? sanitize_text_field($_POST['to_phone']) : '';
    $to_address = isset($_POST['to_address']) ? sanitize_text_field($_POST['to_address']) : '';

    $invoice_id = isset($_POST['invoice_id']) ? sanitize_text_field($_POST['invoice_id']) : '';
    $date_issued = isset($_POST['date_issued']) ? sanitize_text_field($_POST['date_issued']) : '';
    $due_amount = isset($_POST['due_amount']) ? sanitize_text_field($_POST['due_amount']) : '';

    $quotation_products = isset($_POST['quotation_products']) ? $_POST['quotation_products'] : [];

    $shipping_cost = isset($_POST['shipping_cost']) ? sanitize_text_field($_POST['shipping_cost']) : '';
    $vat = isset($_POST['vat']) ? sanitize_text_field($_POST['vat']) : '';

    $quotation_text = isset($_POST['quotation_text']) ? $_POST['quotation_text'] : '';

    $quotation_data = array(
        'post_title'    => 'Quatation Item No ' . time(),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'inventory-quotation',
    );
    $quotation_id = wp_insert_post($quotation_data);
    if ($quotation_id) {
        update_post_meta($quotation_id, 'quotation_title', $quotation_title);
        update_post_meta($quotation_id, 'currency', $currency);

        update_post_meta($quotation_id, 'billing_from', $billing_from);
        update_post_meta($quotation_id, 'billing_email', $billing_email);
        update_post_meta($quotation_id, 'billing_phone', $billing_phone);
        update_post_meta($quotation_id, 'billing_address', $billing_address);

        update_post_meta($quotation_id, 'billing_to', $billing_to);
        update_post_meta($quotation_id, 'to_email', $to_email);
        update_post_meta($quotation_id, 'to_phone', $to_phone);
        update_post_meta($quotation_id, 'to_address', $to_address);

        update_post_meta($quotation_id, 'invoice_id', $invoice_id);
        update_post_meta($quotation_id, 'date_issued', $date_issued);
        update_post_meta($quotation_id, 'due_amount', $due_amount);

        update_post_meta($quotation_id, 'quotation_products', json_encode($quotation_products));

        update_post_meta($quotation_id, 'shipping_cost', $shipping_cost);
        update_post_meta($quotation_id, 'vat', $vat);

        update_post_meta($quotation_id, 'quotation_text', $quotation_text);

        wp_send_json_success(['success' => true, 'cost_type' => 'quotation']);
    }
    wp_die();
}
add_action('wp_ajax_quotation_submission_form_handler', 'quotation_submission_form_handler');
add_action('wp_ajax_nopriv_quotation_submission_form_handler', 'quotation_submission_form_handler');

/** 
 * 
 * login_submission_form_handler
 * 
 */
function account_submission_form_handler()
{
    $current_user_id = get_current_user_id();
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $user_data = array(
        'ID' => $current_user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'display_name' => $first_name . ' ' . $last_name,
    );
    $updated = wp_update_user($user_data);
    if (!is_wp_error($updated)) {
        wp_send_json_success(['success' => true, 'cost_type' => 'account']);
    }
    wp_die();
}
add_action('wp_ajax_account_submission_form_handler', 'account_submission_form_handler');
add_action('wp_ajax_nopriv_account_submission_form_handler', 'account_submission_form_handler');


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

/** 
 * 
 * handle_product_images_upload
 * 
 */
function handle_product_images_upload($file_input_name, $image_key_name = '')
{
    $uploaded_images = [];
    if (empty($_FILES[$file_input_name])) {
        return $uploaded_images;
    }
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $files = $_FILES[$file_input_name];
    $is_multidimensional = is_array($files['name'][0]);
    foreach ($files['name'] as $index => $file_name) {
        if ($is_multidimensional && isset($files['name'][$index][$image_key_name])) {
            foreach ($files['name'][$index][$image_key_name] as $key => $value) {
                process_image_upload($files, $index, $image_key_name, $key, $uploaded_images);
            }
        } else {
            process_image_upload($files, $index, null, null, $uploaded_images);
        }
    }
    return $uploaded_images;
}
function process_image_upload($files, $product_index, $image_key_name, $image_key, &$uploaded_images)
{
    if ($image_key !== null && $image_key_name !== null) {
        $file = [
            'name' => $files['name'][$product_index][$image_key_name][$image_key],
            'tmp_name' => $files['tmp_name'][$product_index][$image_key_name][$image_key],
            'type' => $files['type'][$product_index][$image_key_name][$image_key],
            'error' => $files['error'][$product_index][$image_key_name][$image_key]
        ];
    } else {
        $file = [
            'name' => $files['name'][$product_index],
            'tmp_name' => $files['tmp_name'][$product_index],
            'type' => $files['type'][$product_index],
            'error' => $files['error'][$product_index]
        ];
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return;
    }
    $name = sanitize_file_name($file['name']);
    $tmp = $file['tmp_name'];
    $type = $file['type'];
    if (strpos($type, 'image/') !== 0 && $type !== 'application/pdf') {
        return;
    }
    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['path'] . '/' . $name;
    if (!move_uploaded_file($tmp, $upload_path)) {
        return;
    }
    $attachment = [
        'guid' => $upload_dir['url'] . '/' . $name,
        'post_mime_type' => $type,
        'post_title' => sanitize_file_name(pathinfo($name, PATHINFO_FILENAME)),
        'post_content' => '',
        'post_status' => 'inherit'
    ];
    $attach_id = wp_insert_attachment($attachment, $upload_path);
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    $uploaded_images[] = [
        'url' => $upload_dir['url'] . '/' . $name,
        'id'  => $attach_id
    ];
}
