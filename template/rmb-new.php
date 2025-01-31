<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: RMB New
*/

get_header();

$cost_text = 'RMB';
$cost_type = 'rmb';
get_template_part('template-parts/common/product-list-new', null, ['cost_text' => $cost_text, 'cost_type' => $cost_type]);

get_footer();
