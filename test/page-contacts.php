<?php
/*
Template Name: Contacts
*/

get_header();
?>

<main class="main">
    <section class="info">
        <div class="container">
            <div class="info__inner">
                <h2 class="info__title">
                    <?php the_field('title'); ?>
                </h2>
                <div class="info__text">
                    <?php the_field('text'); ?>
                </div>
            </div>          
        </div>
    </section>
    <section class="map">
        <div>
            <?php echo do_shortcode('[wpgmza id="1"]') ?>
        </div>
        <div class="map__info">
        <div class="map__info-logo">
        <?php
            $custom_logo_id = get_theme_mod('custom_logo');

            if($custom_logo_id){
            echo wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                'class' => 'map__logo-img',
                'itemprop' => 'logo'
            ));
            }
        ?>  
        </div>
        <h3 class="map__info-title"><?php the_field('title-map'); ?></h3>
        <ul class="map__info-list">
            <li class="map__info-item">
                Адресс: 
                <p><?php the_field('adress', 12); ?></p>
            </li>
            <li class="map__info-item">
                Телефон: <a class="map__info-phone map__info-link" href="tel:+<?php the_field('phone', 12); ?>">+<?php the_field('phone', 12); ?></a>
            </li>
            <li class="map__info-item">
                Email: <a class="map__info-email map__info-link" href="mailto:<?php the_field('email', 12); ?>"><?php the_field('email', 12); ?></a>
            </li>
        </ul>
        </div>
  </section>
</main>


<?php get_footer(); ?>