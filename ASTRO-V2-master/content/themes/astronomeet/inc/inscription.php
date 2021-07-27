<?php
function meet_inscription() {
    global $wpdb;
    if(isset($_POST['inscription']) && $_POST['hidden'] == "1") {
        $name = $_POST['name'];
        $message = $_POST['message'];
        
        $table = $wpdb->prefix . 'entrants';

        $data = array(
            'name' => $name,
            'message' => $message
        );

        $format = array(
            '%s',
            '%s'
        );

        $wpdb->insert($table, $data, $format);    
    }

}  

