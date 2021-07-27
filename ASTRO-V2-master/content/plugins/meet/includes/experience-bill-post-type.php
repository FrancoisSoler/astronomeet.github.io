<?php

// Custom post type Experience-bill
// Doc register_post_type: https://codex.wordpress.org/Function_Reference/register_post_type
// function __(): s'il n'existe pas de traduction, ou si le textdomain n'est pas chargé, alors le texte original est retourné (https://developer.wordpress.org/reference/functions/__/)
// function _x(): récupère la traduction de la chaîne grace au paramètre 'context' (https://developer.wordpress.org/reference/functions/_x/) 
// Doc textdomain: https://developer.wordpress.org/themes/functionality/internationalization/#text-domain

function experience_bill_init() {
    $labels = array(
        'name'               => _x( 'Billets de Meet', 'general name for the post type', 'experience-bill' ),
        'singular_name'      => _x( 'Billet de Meet', 'name for one object of this post type', 'experience-bill' ),
        'menu_name'          => __( 'Billets Meet', 'experience-bill' ),
        'name_admin_bar'     => __( 'Billets Meet', 'experience-bill' ),
        'add_new'            => __( 'Ajouter un nouveau', 'experience-bill', 'experience-bill' ),
        'add_new_item'       => __( 'Ajouter un nouveau billet Meet', 'experience-bill' ),
        'new_item'           => __( 'Nouveau billet Meet', 'experience-bill' ),
        'edit_item'          => __( 'Editer le billet Meet', 'experience-bill' ),
        'view_item'          => __( 'Voir billet Meet', 'experience-bill' ),
        'all_items'          => __( 'Tous les billets Meet', 'experience-bill' ),
        'search_items'       => __( 'Rechercher les billets Meet', 'experience-bill' ),
        'not_found'          => __( 'Aucun billet Meet trouvé', 'experience-bill' ),
        'featured_image'     => __( 'Image billet Meet', 'experience-bill' )
    );

    $args = array(

        'labels'             => $labels,
        'description'        => 'A custom post type for Meet bills',
        'menu_icon'          => 'dashicons-edit',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'billets-meets' ),
        'supports'           => array( 'title', 'editor', 'excerpt'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );

    register_post_type ( 'experience-bill', $args );
}
