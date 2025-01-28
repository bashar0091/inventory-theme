<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: Quotation New
*/

get_header();

get_template_part('template-parts/common/product-list-new', null, ['quotation_new' => true]);

get_footer();
