<?php
get_header();

?>

<div class="meetsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="meetsPage__content__backSlide1 rellax" data-rellax-speed="-6">
        <div class="meetsPage__content__backSlide1__titleSingle">
            <?php the_title(); ?>
        </div>
        <video src="<?= get_theme_file_uri('public/videos/cycle3.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>

    <!-- Layout: meets-section -->
    <section class="meets" data-aos="bg-transition4" data-aos-anchor-placement="center-bottom">

        <!-- commenter le contenu de ce block si besoin pour l'utiliser en zone de test -->
        <div class="meets__nextMeet">
            <?php

            global $wpdb;
            global $current_user;

            while (have_posts()) {
                the_post();

                $meet_id = get_the_ID();
                // Création d'une variable indiquant si l'utilisateur connecté est déjà inscrit au meet, grâce à notre table custom. 
                // Elle permettra l'affichage ou non des boutons d'inscription et de désincription au meet:
                
                $is_registered = $wpdb->get_results( "SELECT * FROM `wp_entrants` WHERE `entrant_id`= $current_user->ID AND `meet_id`= $meet_id", OBJECT );

                $users_count = count($wpdb->get_results( "SELECT * FROM `wp_entrants` WHERE `meet_id`= $meet_id", OBJECT ));

            ?>

                <div class="meets__nextMeet__sectionTitle"></div>

                <div class="meets__nextMeet__content" data-aos="fade-up" data-aos-duration="1200" data-aos-anchor-placement="center-bottom">

                    <h5 class="meets__nextMeet__content__title id-getter" data-id="<?= get_the_ID() ?>">
                        Le <?php echo get_post_meta(get_the_ID(), '_start_month', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_day', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_year', true); ?> à <?php echo get_post_meta(get_the_ID(), '_start_hour', true); ?> : <?php echo get_post_meta(get_the_ID(), '_start_minute', true); ?>
                    </h5>

                    <h6 class="meets__nextMeet__content__location">
                        A <?php echo get_post_meta(get_the_ID(), '_meet_location', true); ?>
                    </h6>

                    <h6 class="meets__nextMeet__content__level">
                        <?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?>
                    </h6>

                    <h6 class="meets__nextMeet__content__registeredUsers">
                        <?= $users_count ?> inscrit(e)(s)
                    </h6>

                    <p class="meets__nextMeet__content__excerpt">
                        <?php the_content(); ?>
                    </p>

                    <span class="meets__nextMeet__content__infos">
                        <p> Posté par <?php the_author(); ?></p>
                    </span>
                    <?php if (is_user_logged_in() && !$is_registered) { ?><button id="login" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Je m'inscris
                        </button> <?php } ?>
                    <?php if (!is_user_logged_in()) { ?>                        
                    <button id="connect" type="button" class="btn btn-primary" onclick="window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';">
                            Connectez-vous pour participer
                    </button> <?php 
                    } ?>
                    <button id="logOut" type="button" <?php if (!$is_registered) { ?>style="visibility:hidden"<?php } ?> class="btn btn-secondary" data-toggle="modal" data-target="#logOutModal">
                            Se désinscrire
                    </button> 
                    <center>
                        <div id="result" style="visibility:hidden"> Votre inscription au meet est bien prise en compte</div>
                    </center>
                    <center>
                        <div id="logOutAlert" style="visibility:hidden"> Votre désinscription au meet est bien prise en compte</div>
                    </center>
                </div>

                <div class="meets__nextMeet__imageArea">
                    <div class="meets__nextMeet__imageArea__imgContainer">
                        <img class="meets__nextMeet__imageArea__imgContainer__img" src="<?php echo get_the_post_thumbnail_url() ?>" alt="" data-aos="fade-left" data-aos-duration="2000" data-aos-anchor-placement="center-bottom">
                    </div>
                    <span class="meets__nextMeet__imageArea__bg" data-aos="fade-left" data-aos="fade-left" data-aos-duration="1600" data-aos-anchor-placement="center-bottom" data-aos-delay="800"></span>

                </div>
            <?php  }

            ?>

        </div>

        <div class="meets__incoming">

            <div class="meets__incoming__sectionTitle" data-aos="fade-right" data-aos-duration="1600" data-aos-anchor-placement="center-bottom" data-aos-delay="0">Les prochains meets</div>

            <!-- Component: smallNews  -->

            <?php $lastMeet = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'meet',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            ));
            ?>

            <?php while ($lastMeet->have_posts()) {
                $lastMeet->the_post();
            ?>

                <div class="smallNews">

                    <div class="smallNews__header">
                        <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                        <h6 class="smallNews__header__category"><?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?></h6>
                    </div>

                    <div class="smallNews__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="smallNews__imgContainer__image" src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></a>
                    </div>

                    <div class="smallNews__content">


                        <p class="smallNews__content__infos">Publié le <?php the_date(); ?> par <?php the_author(); ?></p>

                    </div>

                </div>
            <?php } ?>
        </div>

        <div class="meets__latest">

            <div class="meets__latest__sectionTitle" data-aos="fade-left" data-aos-duration="1600" data-aos-anchor-placement="center-bottom" data-aos-delay="0">Voir les derniers meets</div>
            <?php
            // On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type experience-bill)
            $today = date('Ymd');
            $lastMeet = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'experience-bill',
                'orderby' => 'rand',
                'order' => 'ASC',
            ));
            ?>

            <!-- Component: smallNews  -->

            <?php while ($lastMeet->have_posts()) {
                $lastMeet->the_post();
            ?>

                <div class="smallNews">

                    <div class="smallNews__header">
                        <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                        <h6 class="smallNews__header__category"><?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?></h6>
                    </div>

                    <div class="smallNews__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="smallNews__imgContainer__image" src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></a>
                    </div>

                    <div class="smallNews__content">


                        <p class="smallNews__content__infos">Publié le <?php the_date(); ?> par <?php the_author(); ?></p>

                    </div>

                </div>
            <?php } ?>

        </div>
        <p class="smallNews__header__title"><a href="<?php echo get_post_type_archive_link('meet'); ?>">Consulter tous les Meets</a></p>
    </section>

    
    <div class="meetsPage__content__backSlide3">

    </div>
</div>



<?php

get_footer();
