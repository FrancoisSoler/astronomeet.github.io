<?php
get_header();
?>

<div class="staticPage">
    <?php if (have_posts()) :
        while (have_posts()) :

    ?>

<div class="staticPage__backSlide1">
                    <div class="staticPage__backSlide1__title">
                        <?php the_title(); ?>
                    </div>
                    <video src="<?= get_theme_file_uri('public/videos/cycle2.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
                </div>

            <div class="staticPage__content">

            <?php

            the_post();
            the_content();

    endwhile;
    endif; ?>

            </div>

</div>

<?php
get_footer();
