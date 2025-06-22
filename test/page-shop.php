<?php
/*
Template Name: Shop
*/

get_header();


?>

  <main class="main">
    <section class="shop">
      <div class="container">
        <div class="shop__inner">
          <?php get_sidebar(); ?>
          <div class="shop__content">
            <ul class="shop-services__items">
                <?php
                    $categories = get_terms(array(
                    'taxonomy' => 'service_cat', 
                    'hide_empty' => true,
                    ));

                    $first_category_id = $categories[0]->term_id;


                    if ($first_category_id) {
                        $args = array(
                            'post_type' => 'services',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service_cat',
                                    'field' => 'term_id',
                                    'terms' => $first_category_id,
                                ),
                            ),
                        );
                    }
                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                        $query->the_post();
                    ?>
                        <div class="shop-services__item">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="shop-services__img">
                        <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <?php endif; ?>
                        <h2 class="shop-services__title"><?php the_title(); ?></h2>
                        <div class="shop-services__text"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="shop-services__btn">Подробнее</a>
                        </div>
                    <?php  }  } wp_reset_postdata();
                ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
    
<?php get_footer(); ?>