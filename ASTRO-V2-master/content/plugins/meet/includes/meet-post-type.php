<?php

// Custom post type Meet
// Doc register_post_type: https://codex.wordpress.org/Function_Reference/register_post_type
// function __(): s'il n'existe pas de traduction, ou si le textdomain n'est pas chargé, alors le texte original est retourné (https://developer.wordpress.org/reference/functions/__/)
// function _x(): récupère la traduction de la chaîne grace au paramètre 'context' (https://developer.wordpress.org/reference/functions/_x/) 
// Doc textdomain: https://developer.wordpress.org/themes/functionality/internationalization/#text-domain

function meet_init() {
    $labels = array(
        'name'               => _x( 'Meet', 'general name for the post type', 'meet' ),
        'singular_name'      => _x( 'Meet', 'name for one object of this post type', 'meet' ),
        'menu_name'          => __( 'Meets', 'meet' ),
        'name_admin_bar'     => __( 'Meets', 'meet' ),
        'add_new'            => __( 'Ajouter un nouveau', 'meet', 'meet' ),
        'add_new_item'       => __( 'Ajouter un nouveau Meet', 'meet' ),
        'new_item'           => __( 'Nouveau Meet', 'meet' ),
        'edit_item'          => __( 'Editer le Meet', 'meet' ),
        'view_item'          => __( 'Voir Meet', 'meet' ),
        'all_items'          => __( 'Tous les Meets', 'meet' ),
        'search_items'       => __( 'Rechercher les Meets', 'meet' ),
        'not_found'          => __( 'Aucun Meet trouvé', 'meet' ),
        'featured_image'     => __( 'Meet Image', 'meet' )
    );

    $args = array(

        'labels'             => $labels,
        'description'        => 'A custom post type for Meets',
        'menu_icon'          => 'dashicons-calendar-alt',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'meets' ),
        'supports'           => array( 'title', 'editor', 'excerpt'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );

    register_post_type ( 'meet', $args );
}

// Permet de rajouter des champs personnalisés dans le backoffice pour les Meets
/*function add_custom_fields_support_for_meet() {
    add_post_type_support( 'meet', 'custom-fields' );
}
*/

// On ajoute une metabox "Lieu" pour les Meets : https://developer.wordpress.org/reference/functions/add_meta_box/

/* function add_meet_title_metabox() {
    add_meta_box(
        'meets_title',
        'Titre du Meet',
        'meet_title_metabox_html',
        'meet',
        'normal',
        'default'
    );
 }
 
 add_action('add_meta_boxes', 'add_meet_title_metabox');
 */

function add_meet_location_metabox() {
   add_meta_box(
       'meets_location',
       'Lieu du Meet',
       'meet_location_metabox_html',
       'meet',
       'normal',
       'default'
   );
}

add_action('add_meta_boxes', 'add_meet_location_metabox');

/*
function add_meet_description_metabox() {
    add_meta_box(
        'meets_description',
        'Description du Meet',
        'meet_description_metabox_html',
        'meet',
        'advanced',
        'default'
    );
}
 
 add_action('add_meta_boxes', 'add_meet_description_metabox');
 */


/* function add_meet_date_metabox() {
    add_meta_box(
        'meets_date',
        'Date du Meet',
        'meet_date_metabox_html',
        'meet',
        'side',
        'default'
    );
}
*/

add_action('add_meta_boxes', 'add_meet_date_metabox');

// Structure html de la metabox Meet Location

  function meet_title_metabox_html($post) {
    // on récupère la valeur actuelle pour la mettre dans le champ
    $titlevalue  = get_post_meta($post->ID,'_meet_title',true);
    echo '<label for="location">Titre</label>';
    echo '<input id="location" type="text" name="_meet_title" value="'.$titlevalue.'" />';
  }

  function meet_location_metabox_html($post) {
    // on récupère la valeur actuelle pour la mettre dans le champ
    $locationvalue  = get_post_meta($post->ID,'_meet_location',true);
    echo '<label for="location">Lieu : </label>';
    echo '<input id="location" type="text" name="_meet_location" value="'.$locationvalue.'" />';
  }

  function meet_description_metabox_html($post) {
    // on récupère la valeur actuelle pour la mettre dans le champ
    $descriptionvalue  = get_post_meta($post->ID,'_meet_description',true);
    echo '<label for="description">Description</label>';
    echo '<input id="description" type="text" name="_meet_description" value="'.$descriptionvalue.'" />';
  }

  /*function meet_date_metabox_html($post) {
    // on récupère la valeur actuelle pour la mettre dans le champ
    $datevalue  = get_post_meta($post->ID,'_meet_date',true);
    echo '<label for="date">Date</label>';
    echo '<input id="date" type="date" name="_meet_date" value="'.$datevalue.'" />';
  }
  */

// Ajout des données dans la table wp_postmeta

// save meta box with update
add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){
  // si la metabox est définie, on sauvegarde sa valeur
  if(isset($_POST['_meet_location'])){
    update_post_meta($post_ID,'_meet_location', esc_html($_POST['_meet_location']));
  }
  if(isset($_POST['_meet_title'])){
    update_post_meta($post_ID,'_meet_title', esc_html($_POST['_meet_title']));
  }
  if(isset($_POST['_meet_description'])){
    update_post_meta($post_ID,'_meet_description', esc_html($_POST['_meet_description']));
  }
  /*if(isset($_POST['_meet_date '])){
    update_post_meta($post_ID,'_meet_date', esc_html($_POST['_meet_date']));
  }*/
}

/*function meet_location_save_postdata($post_id)
{
    if (array_key_exists('meet_location_field', $_POST)) {
        update_post_meta(
            $post_id,
            'meet_location_meta_key',
            $_POST['meet_location_field']
        );
    }
}
add_action('save_post', 'meet_location_save_postdata');*/

// ***** Ajout de la metabox Meet Level

function add_meet_level_metabox() {
    add_meta_box(
        'meets_level',
        'Niveau de difficulté du Meet',
        'meet_level_metabox_html',
        'meet',
        'normal',
        'default'
    );
 }

add_action('add_meta_boxes', 'add_meet_level_metabox');

// Structure html de la metabox Meet Level

function meet_level_metabox_html($post) {
    $value = get_post_meta($post->ID, 'meet_level_meta_key', true);
    ?>
    <label for="meet_level_field">Difficulté du Meet</label>
    <select name="meet_level_field" id="meet_level_field" class="postbox">
        <option value="Novice" <?php selected($value, 'novice'); ?>>Novice</option>
        <option value="Amateur" <?php selected($value, 'amateur'); ?>>Amateur</option>
        <option value="Expert" <?php selected($value, 'expert'); ?>>Expert</option>
    </select>
    <?php
}

// Ajout des données dans la table wp_postmeta

function meet_level_save_postdata($post_id) {
    if (array_key_exists('meet_level_field', $_POST)) {
        update_post_meta(
            $post_id,
            'meet_level_meta_key',
            $_POST['meet_level_field']
        );
    }
}

add_action('save_post', 'meet_level_save_postdata');

// *** Meet Date & hour metabox

function add_meet_date_metabox() {
    add_meta_box( 'meet_event_date_start', 'Date et heure du Meet', 'meet_date_metabox_html', 'meet', 'side', 'default', array( 'id' => '_start') );
}
add_action( 'add_meta_boxes', 'add_meet_date_metabox' );

// Metabox HTML
  
function meet_date_metabox_html($post, $args) {
    $metabox_id = $args['args']['id'];
    global $post, $wp_locale;
  
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
  
    $time_adj = current_time( 'timestamp' );
    $month = get_post_meta( $post->ID, $metabox_id . '_month', true );
  
    if ( empty( $month ) ) {
        $month = gmdate( 'm', $time_adj );
    }
  
    $day = get_post_meta( $post->ID, $metabox_id . '_day', true );
  
    if ( empty( $day ) ) {
        $day = gmdate( 'd', $time_adj );
    }
  
    $year = get_post_meta( $post->ID, $metabox_id . '_year', true );
  
    if ( empty( $year ) ) {
        $year = gmdate( 'Y', $time_adj );
    }
  
    $hour = get_post_meta($post->ID, $metabox_id . '_hour', true);
  
    if ( empty($hour) ) {
        $hour = gmdate( 'H', $time_adj );
    }
  
    $min = get_post_meta($post->ID, $metabox_id . '_minute', true);
  
    if ( empty($min) ) {
        $min = '00';
    }
  
    $month_s = '<select name="' . $metabox_id . '_month">';
    for ( $i = 1; $i < 13; $i = $i +1 ) {
        $month_s .= "\t\t\t" . '<option value="' . zeroise( $i, 2 ) . '"';
        if ( $i == $month )
            $month_s .= ' selected="selected"';
        $month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
    }
    $month_s .= '</select>';
  
    echo $month_s;
    echo '<input type="text" name="' . $metabox_id . '_day" value="' . $day  . '" size="2" maxlength="2" />';
    echo '<input type="text" name="' . $metabox_id . '_year" value="' . $year . '" size="4" maxlength="4" /> @ ';
    echo '<input type="text" name="' . $metabox_id . '_hour" value="' . $hour . '" size="2" maxlength="2"/>:';
    echo '<input type="text" name="' . $metabox_id . '_minute" value="' . $min . '" size="2" maxlength="2" />';
  
}
  
// Save the Metabox Data
  
function meet_date_metabox_save_meta( $post_id, $post ) {
  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
  
    if ( !isset( $_POST['ep_eventposts_nonce'] ) )
        return;
  
    if ( !wp_verify_nonce( $_POST['ep_eventposts_nonce'], plugin_basename( __FILE__ ) ) )
        return;
  
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ) )
        return;
  
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though
  
    $metabox_ids = array( '_start', '_end' );
  
    foreach ($metabox_ids as $key ) {
        $meets_meta[$key . '_month'] = $_POST[$key . '_month'];
        $meets_meta[$key . '_day'] = $_POST[$key . '_day'];
            if($_POST[$key . '_hour']<10){
                 $meets_meta[$key . '_hour'] = '0'.$_POST[$key . '_hour'];
             } else {
                   $meets_meta[$key . '_hour'] = $_POST[$key . '_hour'];
             }
        $meets_meta[$key . '_year'] = $_POST[$key . '_year'];
        $meets_meta[$key . '_hour'] = $_POST[$key . '_hour'];
        $meets_meta[$key . '_minute'] = $_POST[$key . '_minute'];
        $meets_meta[$key . '_eventtimestamp'] = $meets_meta[$key . '_year'] . $meets_meta[$key . '_month'] . $meets_meta[$key . '_day'] . $meets_meta[$key . '_hour'] . $meets_meta[$key . '_minute'];
    }
  
    // Add values of $meets_meta as custom fields
  
    foreach ( $meets_meta as $key => $value ) { // Cycle through the $meets_meta array!
        if ( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode( ',', (array)$value ); // If $value is an array, make it a CSV (unlikely)
        if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
            update_post_meta( $post->ID, $key, $value );
        } else { // If the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
    }
  
}
  
add_action( 'save_post', 'meet_date_metabox_save_meta', 1, 2 );

 /* function meets_location() {
	global $post;
     // Nonce field est une mesure de sécurité qui permet de confirmer que le contenu du formulaire provient du site et uniquement du site.
    // Il ne constitue pas une protection absolue mais il est important de l'utiliser dans les formulaires.
     https://developer.wordpress.org/reference/functions/wp_nonce_field/
    
   wp_nonce_field( basename( __FILE__ ), 'meet_fields' );
	// Get the location data if it's already been entered
	$location = get_post_meta( $post->ID, 'location', true );
	// Output the field
	echo '<input type="text" name="location" value="' . esc_textarea( $location )  . '" class="widefat">';
}


// Save the metabox data

function save_meets_meta( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['location'] ) || ! wp_verify_nonce( $_POST['meet_fields'], basename(__FILE__) ) ) {
		return $post_id;
    }

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['date'] ) || ! wp_verify_nonce( $_POST['meet_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$meets_meta['date'] = esc_textarea( $_POST['date'] );
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $meets_meta as $key => $value ) :
		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}

On ajoute une metabox "Date" pour les Meets : https://developer.wordpress.org/reference/functions/add_meta_box/
function add_meet_date_metabox() {
    add_meta_box(
        'meets_date',
        'Date du Meet',
        'meets_date',
        'meet',
        'side',
        'default'
    );
}

function meets_date(){
    // Set HTML here which you want to see under this meta box.
    // Refer https://stackoverflow.com/questions/17651766/jquery-date-picker-multi-select-and-unselect
    // for multiselect datebox.
   echo '<input type="date" id="datePick" name=save-dates/>';
}
add_action( 'add_meta_boxes', 'add_meet_date_metabox' );

function myplugin_save_postdata($post_id){
    if ( 'meet' == $_POST['post_type'] ) {
        update_post_meta($post_id, 'save-dates', sanitize_text_field( $_REQUEST['save-dates'] ));
    }
}

function wporg_add_custom_box()
{
    $screens = ['post', 'wporg_cpt'];
    foreach ($screens as $screen) {
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Difficulté du Meet',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            'meet'                   // Post type
        );
    }
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    ?>
    <label for="wporg_field">Description for this field</label>
    <select name="wporg_field" id="wporg_field" class="postbox">
        <option value="Novice" <?php selected($value, 'novice'); ?>>Novice</option>
        <option value="Amateur" <?php selected($value, 'amateur'); ?>>Amateur</option>
        <option value="Expert" <?php selected($value, 'expert'); ?>>Expert</option>
    </select>
    <?php
}

function wporg_save_postdata($post_id)
{
    if (array_key_exists('wporg_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_wporg_meta_key',
            $_POST['wporg_field']
        );
    }
}
add_action('save_post', 'wporg_save_postdata');
*/