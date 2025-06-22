const swiper = new Swiper('.intro-slider', {
    loop: true,
    centeredSlides: true,
    speed: 600,
    slidesPerView: 1,
    spaceBetween: 20,
    autoplay: {
        delay: 2500,
        reverseDirection: true,
    },
});

const popupBg = document.querySelector('.reviews__form-bg');
const popup = document.querySelector('.reviews__form');
const closePopupButton = document.querySelector('.close-popup');

const popusBtn = document.querySelectorAll('.reviews__btn');

if (popupBg && popup && closePopupButton) {
    popusBtn.forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            popupBg.classList.add('active');
            popup.classList.add('active');
        });
    });

    closePopupButton.addEventListener('click', (e) => {
        popupBg.classList.remove('active');
        popup.classList.remove('active');
    });

    document.addEventListener('click', (e) => {
        if (e.target === popupBg) {
            popupBg.classList.remove('active');
            popup.classList.remove('active');
        }
    });
}

