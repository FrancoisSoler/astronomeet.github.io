<?php

get_header();

?>

<?php
// On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type meet)
$today = date('Ymd');
$nextMeet = new WP_Query(array(
    'posts_per_page' => 10,
    'post_type' => 'meet',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
));
?>

<div class="meetsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="meetsPage__content__backSlide1 rellax" data-rellax-speed="-3">
        <div class="meetsPage__content__backSlide1__title">
            Les meets
        </div>
        <video src="<?= get_theme_file_uri('public/videos/cycle3.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>

    <!-- Layout: meets-section -->
    <section class="meets" data-aos="bg-transition4" data-aos-anchor-placement="center-bottom">
        <?php
        while ($nextMeet->have_posts()) {
            $nextMeet->the_post();

            $meet_id = get_the_ID();

            $users_count = count($wpdb->get_results( "SELECT * FROM `wp_entrants` WHERE `meet_id`= $meet_id", OBJECT ));
        ?>
            <!-- commenter le contenu de ce block si besoin pour l'utiliser en zone de test -->
            <div class="meets__nextMeet">

                <div class="meets__nextMeet__content" data-aos="fade-up" data-aos-delay="600" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">

                    <h5 class=meets__nextMeet__content__title>
                        <a href="<?php the_permalink() ?>">Le <?php echo get_post_meta(get_the_ID(), '_start_month', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_day', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_year', true); ?>: <?php the_title(); ?></a>
                    </h5>

                    <h5 class=meets__nextMeet__content__location>
                        <?php echo get_post_meta(get_the_ID(), '_meet_location', true); ?>
                    </h5>

                    <h6 class="meets__nextMeet__content__level">
                        <?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?>
                    </h6>


                    <h6 class="meets__nextMeet__content__registeredUsers"><?= $users_count ?> inscrit(e)(s)
                    </h6>

                    <div class="meets__nextMeet__content__excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <span class="meets__nextMeet__content__infos">
                        <p>Posté par <?php the_author(); ?></p>
                        <p>Heure de début du Meet: <?php echo get_post_meta(get_the_ID(), '_start_hour', true); ?>h<?php echo get_post_meta(get_the_ID(), '_start_minute', true); ?> </p>
                    </span>
                </div>

                <div class="meets__nextMeet__imageArea">
                    <div class="meets__nextMeet__imageArea__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="meets__nextMeet__imageArea__imgContainer__img" src="<?php echo get_the_post_thumbnail_url() ?>" data-aos="fade-left" data-aos-delay="600" data-aos-duration="2000" data-aos-anchor-placement="top-bottom"></a>
                    </div>
                    <span class="meets__nextMeet__imageArea__bg" data-aos="fade-left" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="2000" data-aos-anchor-placement="top-bottom" data-aos-delay="800"></span>

                </div>

            </div>

            <span class="meets_line"></span>

        <?php
        }
        ?>
    </section>

    <div class="meetsPage__content__backSlide3">
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    </div>
</div>

<?php

get_footer();
