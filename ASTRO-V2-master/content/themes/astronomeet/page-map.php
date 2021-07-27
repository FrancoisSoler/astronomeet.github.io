<?php
/*
Template Name: page-map
*/
get_header();
?>

<div class="postsPage__content">

    <!-- bannière vidéo: -->
    <!-- commenter ce block pour masquer la bannière -->
    <div class="postsPage__content__backSlideHd rellax" data-rellax-speed="-6">
        <div class="postsPage__content__backSlideHd__title">
        <?php the_title(); ?>
        </div>
        <video src="<?= get_theme_file_uri('public/videos/lapstime-highq.mp4') ?>" autoplay loop muted></video>
    </div>

    <!-- Layout: posts-section -->
    <section class="posts" data-aos="bg-transition5" data-aos-anchor-placement="top-top">

        <!-- commenter le contenu de ce block si besoin pour l'utiliser en zone de test -->
        <div class="posts__currentPost">
        <div class="mapContainer">
            <h3 class="mapContainer__title">
                Carte météo:
            </h3>
            <div id="windy"></div>

            <h3 class="mapContainer__title">
                Carte de pollution lumineuse:
            </h3>
            <iframe src="https://www.datastro.eu/explore/embed/dataset/imageserver/custom/?disjunctive.limitingmag&disjunctive.cloudcover&disjunctive.constellation&disjunctive.country&location=2,0,0.07906&basemap=mapbox.light&static=false&datasetcard=false" width="800" height="600" frameborder="0"></iframe>
        </div>
        </div>

        <div class="posts__incoming">

            <div class="posts__incoming__sectionTitle">Les prochains meets</div>

            <!-- Component: smallNews  -->

           <?php $topGuide = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'meet'
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

        <div class="posts__latest">

            <div class="posts__latest__sectionTitle">Les autres billets de meet</div>
<?php 
// On instancie une variable à l'aide de la classe native à WordPress WP_Query (https://developer.wordpress.org/reference/classes/wp_query/) à laquelle on passe comme arguments le nombre de posts par page et le type de post (ici notre custom post type meet)

$lastGuide = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'experience-bill'
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
        <p class="smallNews__header__title"><a href="<?php echo get_post_type_archive_link('guide-bill'); ?>">Consulter tous les guides</a></p>
    </section>


    <div class="postsPage__content__backSlide3">
        <!-- <video src="/videos/nebula.mp4" autoplay loop muted width="1920px" height="1080px"></video> -->
    </div>
</div>


<?php
get_footer();
