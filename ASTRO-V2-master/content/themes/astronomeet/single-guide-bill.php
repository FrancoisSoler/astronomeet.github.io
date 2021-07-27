<?php
get_header();

?>

<div class="postsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="postsPage__content__backSlide1 rellax" data-rellax-speed="-6">
        <div class="postsPage__content__backSlide1__title">
            <?php the_title(); ?>
        </div>
        <video src="<?= get_theme_file_uri('public/videos/cycle2.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
    </div>

    <!-- Layout: posts-section -->
    <section class="posts" data-aos="bg-transition2" data-aos-anchor-placement="top-top">

        <!-- commenter le contenu de ce block si besoin pour l'utiliser en zone de test -->
        <div class="posts__currentPost">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <div class="posts__currentPost__sectionTitle"></div>


                <div class="posts__currentPost__content">

                    <h5 class=posts__currentPost__content__title><?php the_title(); ?></h5>

                    <div class="posts__currentPost__content__excerpt"><?php the_content(); ?></div>
                    <span class="posts__currentPost__content__infos">
                        <p>Posté par <?php the_author(); ?></p>
                        <p>Le <?php the_date(); ?></p>
                    </span>

                </div>

            <?php }
            ?>

        </div>

        <div class="posts__incoming">

            <div class="posts__incoming__sectionTitle">Sur le même thème</div>

            <!-- Component: smallNews  -->

            <?php $topGuide = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'guide-bill'
            ));


            while ($topGuide->have_posts()) {
                $topGuide->the_post();
            ?>
                <div class="smallNews">

                    <div class="smallNews__header">
                        <h5 class="smallNews__header__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                        <h6 class="smallNews__header__category">Niveau</h6>
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

        <p class="smallNews__header__title"><a href="<?php echo get_post_type_archive_link('guide-bill'); ?>">Consulter tous les guides</a></p>
    </section>


    <div class="postsPage__content__backSlide3">
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    </div>
</div>

<?php

get_footer();
