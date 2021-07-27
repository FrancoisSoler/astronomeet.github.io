<?php

// Custom post type Guide-bill
// Doc register_post_type: https://codex.wordpress.org/Function_Reference/register_post_type
// function __(): s'il n'existe pas de traduction, ou si le textdomain n'est pas chargé, alors le texte original est retourné (https://developer.wordpress.org/reference/functions/__/)
// function _x(): récupère la traduction de la chaîne grace au paramètre 'context' (https://developer.wordpress.org/reference/functions/_x/) 
// Doc textdomain: https://developer.wordpress.org/themes/functionality/internationalization/#text-domain

function guide_bill_init() {
    $labels = array(
        'name'               => _x( 'Guides', 'general name for the post type', 'guide-bill' ),
        'singular_name'      => _x( 'Guide', 'name for one object of this post type', 'guide-bill' ),
        'menu_name'          => __( 'Guides', 'guide-bill' ),
        'name_admin_bar'     => __( 'Guide', 'guide-bill' ),
        'add_new'            => __( 'Ajouter un nouveau', 'guide-bill', 'guide-bill' ),
        'add_new_item'       => __( 'Ajouter un nouveau guide', 'guide-bill' ),
        'new_item'           => __( 'Nouveau Guide', 'guide-bill' ),
        'edit_item'          => __( 'Editer le Guide', 'guide-bill' ),
        'view_item'          => __( 'Voir Guide', 'guide-bill' ),
        'all_items'          => __( 'Tous les guides', 'guide-bill' ),
        'search_items'       => __( 'Rechercher les guides', 'guide-bill' ),
        'not_found'          => __( 'Aucun guide trouvé', 'guide-bill' ),
        'featured_image'     => __( 'Guide Image', 'guide-bill' )
    );

    $args = array(

        'labels'             => $labels,
        'description'        => 'A custom post type for Guide bills',
        'menu_icon'          => 'dashicons-book',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'billets-guides' ),
        'supports'           => array( 'title', 'editor', 'excerpt'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );

    register_post_type ( 'guide-bill', $args );
}
