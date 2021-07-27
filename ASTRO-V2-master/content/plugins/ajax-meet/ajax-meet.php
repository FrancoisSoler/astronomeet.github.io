<?php
/*
Plugin Name: Ajax-meet
Description: Plugin qui permet de gerer la requete Ajax pour la participation aux meets
Author: Team AVA
Version: 1.0.0
*/
add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts');

function ajax_enqueue_scripts() {
    wp_enqueue_script('ajax-meet',
    plugins_url('ajax-meet.js', __FILE__),
    array ('jquery')  , '1.0' , true  
    );
    wp_localize_script('ajax-meet', 'ajaxurl', admin_url('admin-ajax.php')
    );
}

add_action('wp_ajax_nopriv_do_ajax', 'inscription');
add_action('wp_ajax_do_ajax', 'inscription');

function inscription() {
    
    global $wpdb;
    global $current_user;

    $meet_id = $_POST['meet_id'];

    $user_id = get_current_user_id();

    $table = $wpdb->prefix . 'entrants';

    $data = array(
        'meet_id' => $meet_id,
        'entrant_id' => $user_id
    );

    $wpdb->insert($table, $data);
    //$url = get_page_by_title();
        
}

function delete_registered() {

    global $wpdb;
    global $current_user;

    $meet_id = $_POST['meet_id'];

    $user_id = get_current_user_id();

    $table = $wpdb->prefix . 'entrants';

    $data = array(
        'meet_id' => $meet_id,
        'entrant_id' => $current_user->ID
    );
    $wpdb->delete($table, $data);

}

add_action('wp_ajax_nopriv_delete_registered', 'delete_registered');
add_action('wp_ajax_delete_registered', 'delete_registered');
