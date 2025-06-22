<section class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__left">
                <div class="footer__social">
                    <a href="<?php the_field('vk-link'); ?>" class="footer__social-item">
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/social/vk.png" alt="img" class="footer__social-img">
                    </a>
                    <a href="<?php the_field('telegram-link'); ?>" class="footer__social-item">
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/social/telegram.png" alt="img" class="footer__social-img">
                    </a>
                </div>
                <?php the_field('adress', 12); ?>
            </div>
            <ul class="footer__right">
                <?php
                
                    $categories = get_terms(array(
                        'taxonomy' => 'service_cat',
                        'hide_empty' => true
                    ));
                
                    foreach($categories as $category){
                        ?>
                        <li class="footer__category">
                            <a 
                                href="<?= get_page_link(53) ?>"
                                class="footer__category-link" 
                                data-category-id="<?php esc_attr($category->termd_id) ?>"
                            >
                            <?php echo $category->name ?>
                            </a>
                        </li>
    
                <?php } ?>
            </ul>
        </div>
    </div>
</section>

<?php wp_footer(); ?>

</body>

</html>