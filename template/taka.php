<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: TAKA
*/

get_header();

$cost_text = 'Cost in TAKA';
$cost_type = 'taka';
$pdfname = 'Bangladesh-Product-List';

get_template_part('template-parts/common/product-list', null, ['cost_text' => $cost_text, 'cost_type' => $cost_type, 'pdfname' => $pdfname]);

get_footer();
