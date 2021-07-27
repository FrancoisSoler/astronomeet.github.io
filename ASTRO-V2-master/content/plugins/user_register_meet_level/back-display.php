<?php
/**
 * Back end registration
 */

add_action( 'user_new_form', 'astro_admin_registration_form' );
function astro_admin_registration_form( $operation ) {
	if ( 'add-new-user' !== $operation ) {
		// $operation may also be 'add-existing-user'
		return;
	}

	$level = ! empty( $_POST['user_level'] ) ?( $_POST['user_level'] ) : '';

	?>

	<table class="form-table">
		<tr>
			<th><label for="user_level"><?php esc_html_e( 'Connaissez-vous l\'astrophotographie ?', 'astro' ); ?></label> <span class="description"><?php esc_html_e( '(required)', 'crf' ); ?></span></th>
			<td>
            <input type="radio"
                step="1"
                id="novice"
                name="first_level"
                value="<?php echo esc_attr( $level ); ?>"
                class="radio-level"
            /> Je suis débutant <br>

            <input type="radio"
                step="2"
                id="intermediaire"
                name="second_level"
                value="<?php echo esc_attr( $level ); ?>"
                class="radio-level"
            /> Je connais les bases <br>

            <input type="radio"
                step="3"
                id="expert"
                name="third_level"
                value="<?php echo esc_attr( $level ); ?>"
                class="radio-level"
            />  L'astrophotographie n'a pas de secrets pour moi <br>
            <br>

			</td>
		</tr>
    </table>

	<?php
}	