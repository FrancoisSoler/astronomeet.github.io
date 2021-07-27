<?php
/**
 * Plugin Name: Astronomeet login page
 * Plugin URI: http://www.mywebsite.com
 * Description: Display the login page modified 
 * Version: 1.0
 * Author: AVA Team
 * Author URI: http://www.mywebsite.com
 */

add_action('login_head', 'AstronomeetLogin');

function AstronomeetLogin()
{
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
}
