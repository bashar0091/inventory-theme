<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: Quotation
*/

get_header();

$pdfname = 'Quotation-Report';

get_template_part('template-parts/common/product-list', null, ['quotation' => true, 'pdfname' => $pdfname, 'gap' => false]);

get_footer();
