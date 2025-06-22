<?php
/*
Template Name: home

*/

?>

<?php get_header(); ?>
  <main class="main">

    <section class="intro">
      <div class="intro-slider swiper">
        <div class="intro-slider__wrapper swiper-wrapper">

<?php 

global $post;

$myposts = get_posts([
  'numberposts' => -1,
]);

if( $myposts ){
  foreach($myposts as $post){
    setup_postdata($post);
?>   

    <div class="intro-slider__slide swiper-slide">
      <?php the_post_thumbnail(
        array(1280, 600),
        array(
          'class' => 'intro-slider__img'
        )
      ); ?>
      <div class="intro__texts">
        <h3 class="intro__title">
            <?php the_title(); ?> 
        </h3>
        <h4 class="intro__subtitle">
            <?php the_content(); ?>
        </h4>
        <a href="<?= get_page_link(53) ?>" class="intro__btn btn">
            <?php the_field('button-slider', 12); ?>
        </a>
      </div>
    </div>

<?php } } wp_reset_postdata(); ?>
          
        </div>
      </div>
      </div>
    </section>
    <section class="reviews">
      <div class="container">
        <h2 class="reviews__title title">
          <span data-text="<?php the_field('animate'); ?>"><?php the_field('animate'); ?></span>
          <?php the_field('title'); ?>
        </h2>
        <ul class="reviews__items">
            <?php

                $args = array(
                    'post_type' => 'reviews', 
                    'posts_per_page' => 3,
                    'order' => 'DESC'
                );

                $reviews_query = new WP_Query($args);

                if ($reviews_query->have_posts()) {
                    while ($reviews_query->have_posts()) {
                        $reviews_query->the_post(); ?>
                        <li class="reviews__item">
                            <h4 class="reviews__item-title"><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                            <p><?= get_the_date(); ?></p>
                        </li>
                <? } } wp_reset_postdata(); ?>
        </ul>
      </div>
    </section>
  </main>
  




  <?php get_footer(); ?>
