<?php
/*
Template Name: Feedback

*/

get_header();

?>

<main class="main">

    <section class="reviews">
        <div class="container">
            <h2 class="reviews__title title">
                <span data-text="<?php the_field('animate', 12);?>"><?php the_field('animate', 12); ?></span>
                <?php the_field('title', 12); ?>
            </h2>
            <button class="reviews__btn btn">Оставить отзыв</button>
            <ul class="reviews__items">
            <?php
                $args = array(
                    'post_type' => 'reviews', 
                    'posts_per_page' => -1,        
                    'orderby' => 'date',     
                    'order' => 'DESC'      
                );

                $reviews_query = new WP_Query($args);

                if ($reviews_query->have_posts()) {
                    while ($reviews_query->have_posts()) {
                        $reviews_query->the_post(); ?>
                        <li class="reviews__item">
                            <h3 class="reviews__item-title"><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                            <p class="reviews__item-date"><?= get_the_date(); ?></p>
                        </li>
                <? } } wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
    <div class="reviews__form-bg">
        <form class="reviews__form" method="post">
            <input type="text" name="name" class="reviews__form-input" placeholder="Ваше ФИО">
            <input type="tel" name="phone" class="reviews__form-input" placeholder="Ваш номер телефона">
            <input type="email" name="email" class="reviews__form-input" placeholder="Ваша почта">
            <textarea name="review" class="reviews__form-text" placeholder="Ваш отзыв"></textarea>
            <button type="submit">Отправить</button>
        </form>
        <div class="review__success">
        </div>
        <img src="<?php bloginfo('template_url'); ?>/assets/images/popup/close.svg" class="close-popup">
    </div>
</main>

<?php get_footer(); ?>