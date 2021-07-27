<?php
/*
Plugin Name: Astronomeet user's level
Plugin URI: Astronomeet.com
Description: this a small plugin that display a custom field in the register form 
Version: 0.1
Author: AVA TEAM
Author URI:
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// On empêche l'accès direct à nos fichiers
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Dégagez !' );
}

include('front_display.php');
include('back-display.php');

add_action( 'show_user_profile', 'astro_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'astro_show_extra_profile_fields' );

function astro_show_extra_profile_fields( $user ) {
	?>
	<table class="form-table">
		<tr>
			<th><label for="user_level"><?php esc_html_e( 'niveau de l\'inscrit', 'astro' ); ?></label></th>
			<td><?php echo esc_html( get_the_author_meta( 'user_level', $user->ID ) ); ?></td>
		</tr>
	</table>
	<?php
}