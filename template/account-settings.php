<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

auth();

/* 
Template Name: Account Settings
*/

get_header();

get_template_part('template-parts/common/product-list-new', null, ['account' => true]);

get_footer();
