<?php

/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0');

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles()
{

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20);

/**
 * 
 * Required File
 *
 */
require_once get_stylesheet_directory() . '/includes/ajax/main-ajax.php';
require_once get_stylesheet_directory() . '/includes/common-templates/main-template.php';

/**
 * 
 * Dashboard Assets Loading
 *
 */
function spe_inventory_enqueue_scripts()
{
	// CSS file 
	wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/assets/css/lightbox.min.css', false, '1.0.0', '');
	wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/assets/css/main.css', false, '1.0.0', '');
	wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/assets/css/style.css', false, '1.0.0', '');
	// JS file 
	wp_enqueue_script('jquery-js', 'https://code.jquery.com/jquery-3.7.1.min.js', '', '1.0.0', true);
	wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/assets/js/lightbox.min.js', '', '1.0.0', true);
	wp_enqueue_script('kendo-js', get_stylesheet_directory_uri() . '/assets/js/kendo.all.min.js', '', '1.0.0', true);
	wp_enqueue_script('script-js', get_stylesheet_directory_uri() . '/assets/js/script.js', '', '1.0.0', true);
	wp_enqueue_script('customize-js', get_stylesheet_directory_uri() . '/assets/js/customize.js', '', '1.0.0', true);

	// localize js 
	wp_localize_script('customize-js', 'local', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'rmburl' => home_url('/product-list/rmb'),
		'inrurl' => home_url('/product-list/inr'),
		'takaurl' => home_url('/product-list/taka'),
		'sellurl' => home_url('/sell'),
		'quotationurl' => home_url('/quotation'),
		'homeurl' => home_url('/'),
		'loader' => loader_btn(),
		'spinner' => spinnerv1(),
	));
}
add_action('wp_enqueue_scripts', 'spe_inventory_enqueue_scripts');

/**
 * 
 * Logo Get
 *
 */
function logo()
{
	$logo_id = get_theme_mod('custom_logo');
	$logo_url = wp_get_attachment_image_url($logo_id, 'full');
	return $logo_url;
}

/**
 * 
 * Theme assets image
 *
 */
function asset_img($name = '')
{
	$url = get_stylesheet_directory_uri() . '/assets/images/' . $name;
	return $url;
}

/**
 * 
 * Customizer Logo Registration
 *
 */
function white_logo_register($wp_customize)
{
	$wp_customize->add_setting('white_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'white_logo',
		array(
			'label'    => __('White Logo', 'spe-inventory'),
			'section'  => 'title_tagline',
			'settings' => 'white_logo',
			'priority' => 8,
		)
	));
}
add_action('customize_register', 'white_logo_register');

/**
 * 
 * Get Parent Slug with child slug
 *
 */
function parent_page($slug = '')
{
	if (is_page()) {
		global $post;
		if ($post->post_parent) {
			$parent_post = get_post($post->post_parent);
			$parent_slug = $parent_post->post_name;
			if ($parent_slug == $slug) {
				return true;
			}
		}
	}
	return false;
}

/**
 * 
 * auth function
 *
 */
function auth()
{
	if (!is_user_logged_in()) {
		wp_safe_redirect(home_url('/login'));
		exit;
	}
}
function authv2()
{
	if (is_user_logged_in()) {
		wp_safe_redirect(home_url());
		exit;
	}
}

/**
 * 
 * User data
 *
 */
function user_data()
{
	$user_id = get_current_user_id();
	if ($user_id === 0) {
		return false;
	}
	$user_data = get_userdata($user_id);
	if (!$user_data) {
		return false;
	}
	$display_name = $user_data->display_name;
	$gravatar_url = get_avatar_url($user_id, [
		'size' => 96,
	]);
	return [
		'display_name' => $display_name,
		'gravatar_url' => $gravatar_url,
	];
}

/**
 * 
 * User Restrict
 *
 */
function adminon()
{
	return current_user_can('administrator');
}

/**
 * 
 * add_inventory_manager_role
 *
 */
function add_inventory_manager_role()
{
	if (!get_role('inventory_manager')) {
		add_role(
			'inventory_manager',
			'Inventory Manager',
		);
	}
}
add_action('init', 'add_inventory_manager_role');

/**
 * 
 * Hide admin bar
 *
 */
add_filter('show_admin_bar', '__return_false');


/**
 * 
 * Post type calculation
 *
 */
function show_calc($post_type = '', $field = '')
{
	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => -1,
	);

	$query = new WP_Query($args);
	$total = 0;

	if ($query->have_posts()) {
		foreach ($query->posts as $post_id) {
			$total += (float) get_field($field, $post_id);
		}
	}

	return $total;
}

/**
 * 
 * currency_symbol
 *
 */
function currency_symbol()
{
	return '৳';
}
