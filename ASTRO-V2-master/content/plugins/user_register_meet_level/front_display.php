<?php
/**
 * Front end registration
 */

add_action( 'register_form', 'astro_registration_form' );
function astro_registration_form() {

	$level = ! empty( $_POST['user_level'] ) ? ( $_POST['user_level'] ) : '';

	?>
	<p>
		<label for="user_level"><?php esc_html_e( 'Connaissez-vous l\'astrophotographie ?', 'astro' ) ?><br/>
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
		</label>
        </label>
        <script type="text/javascript">
                document.getElementById('clear-button').addEventListener('click', function () {
                ["novice", "intermediaire", "expert"].forEach(function(id) {
                    document.getElementById(id).checked = false;
                });
                return false;
                })
            </script>
	</p>
	<?php
}

add_action( 'user_register', 'custom_user_register' );
function custom_user_register( $user_id ) {
	if ( ! empty( $_POST['user_level'] ) ) {
		update_user_meta( $user_id, 'user_level', intval( $_POST['user_level'] ) );
	}
}

add_action( 'user_profile_update_errors', 'astro_user_profile_update_errors', 10, 3 );
function crf_user_profile_update_errors( $errors, $update, $user ) {
	if ( $update ) {
		return;
	}

	if ( empty( $_POST['user_level'] ) ) {
		$errors->add( 'user_level_error', __( '<strong>ERROR</strong>: merci de renseigner votre niveau.', 'astro' ) );
	}
}

/* add_action( 'edit_user_created_user', 'astro_user_register' ); */