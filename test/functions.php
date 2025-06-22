<?php

add_action( 'wp_enqueue_scripts', 'burex_scripts' );


function burex_scripts() {
    wp_enqueue_style('fonts-googleapis', 'https://fonts.googleapis.com');
    wp_enqueue_style('fonts-gstatic', 'https://fonts.gstatic.com');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_style('style', get_template_directory_uri().'/assets/css/style.css');


    wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script('category', get_template_directory_uri().'/assets/js/filter.js', ('jquery'), null, true);
    wp_localize_script('category', 'ajaxurl', admin_url('admin-ajax.php'));
    wp_enqueue_script('reviews', get_template_directory_uri().'/assets/js/reviews.js', array('jquery'), null, true);
    wp_localize_script('reviews', 'reviewData', array(
        'message' => 'Ваш отзыв успешно отправлен.',
    ));
    add_action('wp_enqueue_scripts', 'enqueue_reviews_script');
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), 'null', true);
}

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('menus');

add_filter('nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 3);

function filter_nav_menu_link_attributes($atts, $item, $args) {
  if($args->menu === 'Main'){
    $atts['class'] = 'header__menu-item';

    if($item->current){
      $atts['class'] .= ' header__menu-item-active';
    }
  };

  return $atts;
}

function create_services_post_type() {
    register_post_type('services', 
        array(
            'labels' => array(
                'name' => 'Услуги',
                'singular_name' => 'Услуга'
            ),
            'public' => true,
            'has_archive' => true,
            'supports'=> array('title', 'editor', 'excerpt', 'thumbnail')
        )
    );
}

function create_services_taxonomy() {
    register_taxonomy(
        'service_cat', 
        'services', 
        array(
            'label' => 'Категории услуг',
            'rewrite' => array('slug' => 'service-category'),
            'hierarchical' => true, 
        )
    );
}

add_action('init', 'create_services_post_type');
add_action('init', 'create_services_taxonomy');

function service_category() {
    $category_id = intval($_POST['category_id']);
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'service_cat',
                'field' => 'term_id',
                'terms' => $category_id,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="shop-services__item">
              <div class="shop-services__img">
                <?php the_post_thumbnail('medium'); ?>
              </div>
              <h2 class="shop-services__title"><?php the_title(); ?></h2>
              <div class="shop-services__text"><?php the_excerpt(); ?></div>
              <a href="<?php the_permalink(); ?>" class="shop-services__btn">Подробнее</a>
            </div>
            <?php
        }
    }

    wp_reset_postdata();
    die();
}

function create_reviews_post_type() {
    register_post_type('reviews',
        array(
            'labels' => array(
                'name' => 'Отзывы',
                'singular_name' => 'Отзыв'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor'),
        )
    );
}
add_action('init', 'create_reviews_post_type');



function review_submit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
        $name = sanitize_text_field($_POST['name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $review = sanitize_textarea_field($_POST['review']);

        $new_review = array(
            'post_title'   => $name,
            'post_content' => $review,
            'post_status'  => 'pending', 
            'post_type'    => 'reviews',  
        );

        $post_id = wp_insert_post($new_review);

        // Telegram
        $telegram_bot_token = '7960240566:AAHn22afdNZHtCy9NP2R3sT9B1m5HdQqX-c';
        $chat_id = '1408201158'; 
        $telegram_message = urlencode("Новый отзыв от: " . $name . "\nТелефон: " . $phone . "\nE-mail: " . $email);
        
        file_get_contents("https://api.telegram.org/bot$telegram_bot_token/sendMessage?chat_id=$chat_id&text=$telegram_message");


        exit;

    }
}

add_action('init', 'review_submit');


add_action('wp_ajax_review_submit', 'review_submit'); 
add_action('wp_ajax_nopriv_review_submit', 'review_submit'); 
add_action('wp_ajax_service_category', 'service_category');
add_action('wp_ajax_nopriv_service_category', 'service_category');
?>