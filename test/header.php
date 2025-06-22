<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
</head>

<body>

  <header class="header">
    <div class="container">
      <div class="header__inner">
        <?php 
        
        $custom_logo_id = get_theme_mod('custom_logo');

        if($custom_logo_id){
          echo wp_get_attachment_image( $custom_logo_id, 'full', false, array(
            'class' => 'custom-logo header__logo-img',
            'itemprop' => 'logo'
          ));
        }
        
        ?>
        <nav class="header__menu">
          <?php
            wp_nav_menu( [
              'menu'            => 'Main',
              'container'       => false,
              'menu_class'      => 'header__menu-list',
              'echo'            => true,
              'items_wrap'      => '<ul class="header__menu-list">%3$s</ul>',
              'depth'           => 0,
            ] );
          ?>
        </nav>
        <div class="header__contacts">
          <a href="tel:+<?php the_field('phone', 12); ?>" class="header__contacts-phone">+<?php the_field('phone', 12); ?></a>
          <p class="header__contacts-address"><?php the_field('adress', 12); ?></p>
        </div>
      </div>
    </div>
  </header>
