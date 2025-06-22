jQuery(document).ready(function ($) {

  function loadeServices(categoryId) {
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        action: 'service_category',
        category_id: categoryId
      },
      success: function (response) {
        $('.shop-services__items').html(response);
      },
    });
  }

  var firstCategoryId = $('.filter__item.active').data('category-id');

  loadeServices(firstCategoryId);

  $('.filter__item').on('click', function (e) {
    e.preventDefault();
    $('.filter__item').removeClass('active');
    $(this).addClass('active');

    var categoryId = $(this).data('category-id');
    loadeServices(categoryId);
  });



});


