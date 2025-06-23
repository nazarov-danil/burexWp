<?php get_header(); ?>

<main class="main">
    <section class="service">
        <div class="container">
            <div class="service__item">
              <div class="service__item-top">
                <div class="service__item-texts">
                  <h3 class="service__item-title">
                    <?php the_title(); ?>
                  </h3>
                  <p class="service__item-description">
                    <?php the_content(); ?>
                  </p>
                </div>
                <?php the_post_thumbnail('medium'); ?>
              </div>
            </div>
          </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>

