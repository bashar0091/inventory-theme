<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: Sell New
*/

get_header();

get_template_part('template-parts/common/product-list-new', null, ['sell_new' => true]);

get_footer();
