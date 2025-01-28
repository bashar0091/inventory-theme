<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: RMB
*/

get_header();

$cost_text = 'Cost in RMB';
$cost_type = 'rmb';
$pdfname = 'China-Product-List';

get_template_part('template-parts/common/product-list', null, ['cost_text' => $cost_text, 'cost_type' => $cost_type, 'pdfname' => $pdfname]);

get_footer();
