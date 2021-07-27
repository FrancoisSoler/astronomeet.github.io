<?php
/*
Plugin Name: Customize back office
Description: Petit plugin pour modifier légèrement le backoffice d'astronomeet
Author: Team AVA
Version: 1.0.0
*/


// disable default dashboard widgets
function disable_default_dashboard_widgets() {

	// disable default dashboard widgets
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_activity', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget

	// disable Simple:Press dashboard widget
	remove_meta_box('sf_announce', 'dashboard', 'normal');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');


// Admin footer modification
  
function remove_footer_admin () 
{
    echo '<span id="footer-thankyou">Fait avec amour par <a href="astrnomeet.com" target="_blank">la team AVA</a></span>';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');

function astro_custom_logo() {
    echo '<style type="text/css">
    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
    background-image: url(' . WP_PLUGIN_URL  . '/customize_backoffice/ico16white.png) !important;
    background-position: 0 0;
    color:rgba(0, 0, 0, 0);
    }
    #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
    background-position: 0 0;
    background-repeat: no-repeat;
    }
    </style>
    ';
}

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'astro_custom_logo');

// remove updates notifications
add_action('after_setup_theme','remove_core_updates');
function remove_core_updates()
{
 if(! current_user_can('update_core')){return;}
 add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 add_filter('pre_option_update_core','__return_null');
 add_filter('pre_site_transient_update_core','__return_null');
}

// remove plugins update notif
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');


// add dashboard banner
function astro_script_enqueuer(){
    echo <<<HTML
    <style type="text/css">#dashboard-widgets-wrap {display:none;}</style>
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        $('#dashboard-widgets-wrap').delay(1200).fadeTo('slow',1);
        $('<div style="width:100%;text-align:center;margin:8px 0"><img src="http://localhost/AVA/projet-ava/content/plugins/customize_backoffice/banniereback2.png" width="1300" height="400"></div>').insertBefore('#dashboard-widgets-wrap');
         $('#wpwrap').css('background-color', "##101010");
          $('.clear').css('background-color', "##101010");

    });     
    </script>
HTML;
}
add_action('admin_head-index.php', 'astro_script_enqueuer');

function astro_remove_drag_box() {
    echo '<style type="text/css">
    #dashboard-widgets {
        display:none;
    }

    </style>
    ';
}

//hook into the administrative header output

add_action('wp_before_admin_bar_render', 'astro_remove_drag_box');

