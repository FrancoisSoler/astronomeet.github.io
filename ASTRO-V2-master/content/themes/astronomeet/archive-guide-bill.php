<?php

get_header();

?>

<?php

// On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type meet)

$nextGuide = new WP_Query(array(
    'posts_per_page' => 10,
    'post_type' => 'guide-bill'
));

?>

<div class="postsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="postsPage__content__backSlide1 rellax" data-rellax-speed="-3">
        <div class="postsPage__content__backSlide1__title">
            Les guides
        </div>
        <video src="<?= get_theme_file_uri('public/videos/cycle2.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>

    <!-- Layout: posts-section -->
    <section class="posts" data-aos="bg-transition2" data-aos-anchor-placement="top-top">
        <?php
        while ($nextGuide->have_posts()) {
            $nextGuide->the_post();
        ?>
            <!-- commenter le contenu de ce block si besoin pour l'utiliser en zone de test -->
            <div class="posts__listedPost">

                <div class="posts__listedPost__content" data-aos="fade-up" data-aos-delay="600" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">

                    <h5 class=posts__listedPost__content__title>
                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    </h5>

                    <div class="posts__listedPost__content__excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <span class="posts__listedPost__content__infos">
                        <p>Posté par <?php the_author(); ?></p>
                    </span>

                </div>

                <div class="posts__listedPost__imageArea">
                    <div class="posts__listedPost__imageArea__imgContainer">
                        <a href="<?php the_permalink() ?>"><img class="posts__listedPost__imageArea__imgContainer__img" src="<?php echo get_the_post_thumbnail_url() ?>" data-aos="fade-left" data-aos-delay="600" data-aos-duration="2000" data-aos-anchor-placement="top-bottom"></a>
                    </div>
                    <span class="posts__listedPost__imageArea__bg" data-aos="fade-left" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="2000" data-aos-anchor-placement="top-bottom" data-aos-delay="800"></span>

                </div>

            </div>

        <?php
        }
        ?>
    </section>


    <div class="postsPage__content__backSlide3">
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    </div>
</div>

<?php

get_footer();
