<?php
/*
Plugin Name: Meet
Description: Plugin qui permet d'organiser les Meets
Author: Team AVA
Version: 1.0.0
*/

// On ajoute un namespace afin de s'assurer de bien séparer le code
namespace ava\meets;

// On empêche l'accès direct à nos fichiers
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'ACCESS DENIED !' );
}

// On définit les constantes
define ( 'PLUGIN_MEETS_DIR_PATH', plugin_dir_path( __FILE__));
define ( 'PLUGIN_MEETS_VERS', '1.0.0');
define ( 'SCRIPTS', PLUGIN_MEETS_DIR_PATH . '/js/');

// Includes
include( 'includes/activate.php' );
include( 'includes/meet-post-type.php');
include( 'includes/experience-bill-post-type.php');
include( 'includes/guide-bill-post-type.php');
include( 'includes/data.php');

// Hooks
register_activation_hook( __FILE__, 'activate_meet_plugin' );
add_action( 'init', 'meet_init' );
add_action( 'init', 'experience_bill_init' );
add_action( 'init', 'guide_bill_init' );
register_activation_hook( __FILE__, 'meet_install_table' );
register_activation_hook( __FILE__, 'meet_register_data' );
register_deactivation_hook(__FILE__, 'remove_plugin_table');
add_action ( 'meet-post-type', 'meet_inscription' );
add_action ( 'init', 'my_meets_list');