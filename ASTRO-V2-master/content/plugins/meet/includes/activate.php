<?php

// Activation du plugin
// Vérification que l'utilisateur utilise une version supérieur à la 5.0 avec la fonction version_compare (https://www.php.net/manual/fr/function.version-compare.php)
// Auquel cas WordPress ne s'exécutera pas et affichera un message invitant l'utilsateur à mettre à jour son WordPress
function activate_meet_plugin() {
    if( version_compare( get_bloginfo( 'version' ), '5.0', '<') ){
        wp_die( __("Veuillez mettre WordPress à jour afin de pouvoir utiliser cet excellent plugin.", 'meet') );
    }
}