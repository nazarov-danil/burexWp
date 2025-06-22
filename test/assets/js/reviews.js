jQuery(document).ready(function($) {
    $('.reviews__form').on('submit', function(e) {
        e.preventDefault(); 

        $.ajax({
            type: 'POST',
            url: window.location.href,
            data: $(this).serialize(), 
            success: function(response) {
                $('.review__success').html(reviewData.message);
                $('.reviews__form')[0].reset(); 
            }
        });
    });
});