<?php
get_header();
?>

<div class="staticPage">


<div class="staticPage__backSlide1">
                    <div class="staticPage__backSlide1__title">
                        Vous êtes perdus...
                    </div>
                    <video src="<?= get_theme_file_uri('public/videos/sun.mp4') ?>" autoplay loop muted width="1920px" height="1080px"></video>
                </div>

            <div class="staticPage__content">
                <p>Il semble que nous n'ayons trouvé ni étoile, ni nébuleuse, ni même une page web à l'adresse demandée.</p>

                <p>Nous continuons de scruter pour vous, mais nous vous conseillons de   a <a href="<?= get_home_url() ?>" class="smallNews__header__title"> revenir à l'accueil -></a></p>

            </div>

</div>

<?php
get_footer();
