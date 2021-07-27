<?php
/*
Template Name: page-myMeets
*/
get_header();

?>

<?php
// On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type meet)
$today = date('Ymd');

?>

<div class="meetsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="meetsPage__content__backSlide1 rellax" data-rellax-speed="-3">
        <div class="meetsPage__content__backSlide1__title">
            Mes inscriptions en cours
        </div>
        <video src="<?= get_theme_file_uri('public/videos/cycle3.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>


    <!-- Layout: meets-section -->
    <section class="meets" data-aos="bg-transition4" data-aos-anchor-placement="center-bottom">


        <div class="my-meets">


        <?php
        if (!is_user_logged_in()) { 
            ?>
            <button id="connect" type="button" class="btn btn-primary" onclick="window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';">
                Connectez-vous pour consulter vos meets
            </button> 
        <?php } else {
        
        if (empty($my_meets_id)) { ?>

        <p>Vous n'êtes pas encore inscrit à un meet.</p>

        <button id="connect" type="button" class="btn btn-primary" onclick="window.location.href='<?php echo get_post_type_archive_link( 'meet' ); ?>';">
        Consulter les meets
        </button>

        <?php } else {
        
        $args = array(
            'post_type' => 'meet',
            'post__in' => $my_meets_id,
            'orderby' => 'post__in',
            'order' => 'ASC',
        );
        $myMeets = new WP_Query($args);        
        
        while ($myMeets->have_posts()) {    
            
            $myMeets->the_post();

            $meet_id = get_the_ID();

            $users_count = count($wpdb->get_results( "SELECT * FROM `wp_entrants` WHERE `meet_id`= $meet_id", OBJECT ));

        ?>

            <div class="smallNews">

                <div class="smallNews__header">
                    <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                    <h6 class="smallNews__header__category"><?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?></h6>
                </div>
                <h6 class="smallNews__header__registeredUsers"><?= $users_count ?> inscrit(e)(s)</h6>

                <div class="smallNews__imgContainer">
                    <a href="<?php the_permalink() ?>"><img class="smallNews__imgContainer__image" src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></a>
                </div>

                <div class="smallNews__content">
                    <p class="smallNews__content__infos">Publié le <?php the_date(); ?> par <?php the_author(); ?></p>
                </div>

            </div>
    
        <?php
            }
        }
    }
        ?>
        </div>
    </section>

    <div class="meetsPage__content__backSlide3">
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    </div>
</div>

<?php


get_footer();
