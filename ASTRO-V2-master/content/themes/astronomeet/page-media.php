<?php
/*
Template Name: Gallery Page
*/

 get_header();
?>
<div class="medias__content">

        <div class="medias__content__backSlide2">
            <div class="medias__content__backSlide2__title">
                Les Medias
            </div>
            <video src="<?= get_theme_file_uri( 'public/videos/cycle.mp4' ) ?>" autoplay loop muted width="1920px" height="1080px"></video>
        </div>

 

<section class="medias">
            <!-- <div class="medias__sectionTitle">Vos medias</div> -->
            <div class="medias__player">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Désolé, aucun post trouvés :( </p>
<?php endif; ?>
            </div>
        </section>

        </div>
<?php
get_footer();


