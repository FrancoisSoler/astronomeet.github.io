<?php

get_header();

?>


<div class="home__content">
    <!-- Layout: intro -->
    <div class="intro__bannerInfos rellax" data-rellax-speed="-5">

        <div class="intro__bannerInfos__logo">
            <img src="<?= get_theme_file_uri('public/images/logo-front.png') ?>" alt="">
        </div>
        <div class="intro__bannerInfos__subtitle">
            <?= get_bloginfo('description') ?>
        </div>

    </div>


    <section class="intro">

        <div class="intro__player">
            <video class="videoToStop" src="<?= get_theme_file_uri('public/videos/earth.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
        </div>

    </section>

    <!-- Layout: presentation -->
    <section class="presentation" data-aos="bg-transition1" data-aos-anchor-placement="top-center">

        <span class="presentation__line"></span>
        <div class="presentation__steps">

            <div class="presentation__steps__step" data-aos="fade-up" data-aos-duration="1200" data-aos-anchor-placement="top-bottom" data-aos-delay="300">
                <div class="presentation__steps__step__number">1</div>
                <h2 class="presentation__steps__step__title"><a href="">Rejoignez la communauté</a></h2>
                <p class="presentation__steps__step__content">Venez <span>partager</span> vos plus beaux clichés,
                    vos
                    expériences, ou <span>participez aux meets</span> organisés entre les membres.</p>
                <a class="presentation__steps__step__link" href="">Inscrivez-vous</a>
            </div>
            <div class="presentation__steps__step" data-aos="fade-up" data-aos-duration="1400" data-aos-anchor-placement="center-bottom" data-aos-delay="400">
                <div class="presentation__steps__step__number">2</div>
                <h2 class="presentation__steps__step__title"><a href="">Rejoignez ou créez un meet</a></h2>
                <p class="presentation__steps__step__content">Lorem ipsum dolor sit amet, consetetur <span>sadipscing</span>elitr, sed diam nonumy eirmod <span>tempor</span> invidunt amet sed dolor.</p>
                <a class="presentation__steps__step__link" href="">Accéder aux ressources</a>
            </div>
            <div class="presentation__steps__step" data-aos="fade-up" data-aos-duration="1600" data-aos-anchor-placement="bottom-bottom" data-aos-delay="500">
                <div class="presentation__steps__step__number">3</div>
                <h2 class="presentation__steps__step__title"><a href="">Préparez votre session</a></h2>
                <p class="presentation__steps__step__content">Consultez le <span>calendrier</span> des phénomènes et profitez des <span>guides</span> pour préparer au mieux votre session astro-photographique.</p>
                <a class="presentation__steps__step__link" href="">Accéder aux meets</a>
            </div>
        </div>

        <div class="nextMeet">
            <?php
            // On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type meet)
            $today = date('Ymd');
            $nextMeet = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type' => 'meet',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            ));


            while ($nextMeet->have_posts()) {
                $nextMeet->the_post();
            ?>

                <div class="nextMeet__sectionTitle"></div>

                <div class="nextMeet__content" data-aos="fade-up" data-aos-duration="1200" data-aos-anchor-placement="top-bottom">

                    <h5 class="nextMeet__content__title id-getter" data-id="<?= get_the_ID() ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    </h5>

                    <h6 class="nextMeet__content__location">
                        A <?php echo get_post_meta(get_the_ID(), '_meet_location', true); ?>, le <?php echo get_post_meta(get_the_ID(), '_start_month', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_day', true); ?>/<?php echo get_post_meta(get_the_ID(), '_start_year', true); ?> à <?php echo get_post_meta(get_the_ID(), '_start_hour', true); ?> : <?php echo get_post_meta(get_the_ID(), '_start_minute', true); ?>
                    </h6>

                    <h6 class="nextMeet__content__level">
                        <?php echo get_post_meta(get_the_ID(), 'meet_level_meta_key', true); ?>
                    </h6>

                    <p class="nextMeet__content__excerpt">
                        <?php the_content(); ?>
                    </p>

                    <span class="nextMeet__content__infos">
                        <p> Posté par <?php the_author(); ?></p>
                    </span>

                </div>

                <div class="nextMeet__imageArea">
                    <div class="nextMeet__imageArea__imgContainer">
                        <a href="<?php the_permalink() ?>">
                            <img class="nextMeet__imageArea__imgContainer__img" src="<?php echo get_the_post_thumbnail_url() ?>" alt="" data-aos="fade-left" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">
                        </a>
                    </div>
                    <span class="nextMeet__imageArea__bg" data-aos="fade-left" data-aos="fade-left" data-aos-duration="1600" data-aos-anchor-placement="top-bottom" data-aos-delay="800"></span>

                </div>
            <?php  }

            ?>

        </div>

    </section>

    <div class="home__content__backSlide1">
        <div class="home__content__backSlide1__title rellax" data-rellax-speed="-2">
            Les News
        </div>
        <video class="videoToStop" src="<?= get_theme_file_uri('public/videos/cycle2.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>

    <!-- Layout: news -->
    <section class="news" data-aos="bg-transition2" data-aos-anchor-placement="top-bottom">

        <div class="news__top">



            <div id="aosTrigger" class="news__top__sectionTitle">Top news</div>

            <?php $topGuide = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type' => 'guide-bill',
                'orderby' => 'rand',
                'order' => 'ASC'
            ));
            while ($topGuide->have_posts()) {
                $topGuide->the_post();
            ?>

                <div class="news__top__content" data-aos="fade-up" data-aos-duration="2400" data-aos-delay="800" data-aos-anchor="#aosTrigger" data-aos-anchor-placement="center-bottom">

                    <h5 class=news__top__content__title><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <!-- <h6 class="news__top__content__category">Catégorie</h6> -->

                    <span class="news__top__content__excerpt"><?php the_excerpt(); ?>
                    </span>
                    <span class="news__top__content__infos">Posté le <?php the_date(); ?> par <?php the_author(); ?></span>

                </div>

                <div class="news__top__imageArea">
                    <div class="news__top__imageArea__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="news__top__imageArea__imgContainer__img" src="<?php echo get_the_post_thumbnail_url() ?>" alt="" data-aos="fade-left" data-aos-duration="2000" data-aos-anchor="#aosTrigger" data-aos-anchor-placement="top-center"></a>
                    </div>
                    <span class="news__top__imageArea__bg" data-aos="fade-left" data-aos="fade-left" data-aos-duration="2500" data-aos-delay="600" data-aos-anchor="#aosTrigger" data-aos-anchor-placement="top-center"></span>
                </div>

            <?php
            } ?>
        </div>

        <div class="news__latests">

            <div class="news__latests__sectionTitle" data-aos="fade-right" data-aos-duration="1600" data-aos-anchor-placement="center-bottom" data-aos-delay="0">Les billets de meets</div>

            <?php $lastBill = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'experience-bill',
                'orderby' => 'rand'
            ));
            while ($lastBill->have_posts()) {
                $lastBill->the_post();
            ?>
                <!-- Component: smallNews  -->
                <div class="smallNews">

                    <div class="smallNews__header">
                        <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                        <h6 class="smallNews__header__category">Catégorie</h6>
                    </div>
                    <div class="smallNews__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="smallNews__imgContainer__image" src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></a>
                    </div>
                    <div class="smallNews__content">
                        <p class="smallNews__content__infos">Publié le <?php the_date(); ?> par <?php the_author(); ?></p>
                    </div>

                </div>

            <?php
            } ?>

        </div>

        <div class="news__guides">

            <div class="news__latests__sectionTitle" data-aos="fade-left" data-aos-duration="1600" data-aos-anchor-placement="center-bottom" data-aos-delay="0">Les derniers guides</div>
            <?php $lastGuide = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'guide-bill',
                'orderby' => 'rand'
            ));
            while ($lastGuide->have_posts()) {
                $lastGuide->the_post();
            ?>
                <!-- Component: smallNews  -->
                <div class="smallNews">
                    <div class="smallNews__header">
                        <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                    </div>
                    <div class="smallNews__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="smallNews__imgContainer__image" src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></a>
                    </div>
                    <div class="smallNews__content">
                        <p class="smallNews__content__infos">Publié le <?php the_date(); ?> par <?php the_author(); ?></p>
                    </div>
                </div>
            <?php
            } ?>


        </div>

    </section>
    <!-- <div class="meetsPage__content__backSlide3"> -->
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    <!-- </div> -->
</div>
<?php

get_footer();
