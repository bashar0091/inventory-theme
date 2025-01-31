<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: Sell
*/

get_header();

$pdfname = 'Sells-Report';

get_template_part('template-parts/common/product-list', null, ['sell' => true, 'pdfname' => $pdfname, 'gap' => false]);

get_footer();
