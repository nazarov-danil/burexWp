<aside class="sidebar filter">
  <h3 class="filter__title">Категории</h3>
  <?php
  $categories = get_terms(array(
    'taxonomy' => 'service_cat', 
    'hide_empty' => true,
  ));

  $first_category_id = $categories[0]->term_id; // По умолчанию первая

  if (!empty($categories)) {   

    foreach ($categories as $category) {
      $active_class = ($category->term_id === $first_category_id) ? 'active' : '';
    
    ?>
        <button type="button" data-category-id="<?php echo esc_attr($category->term_id) ?> "class="filter__item <?php echo esc_attr($active_class) ?>">
        <?php echo esc_html($category->name); ?>
        </button>

    <?php } }?>

</aside>


<?php
