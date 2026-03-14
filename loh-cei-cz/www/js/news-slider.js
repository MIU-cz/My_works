// {* --- 2. NOVÉ AKTUÁLNĚ (DYNAMICKÉ) --- *}

$(document).ready(function() {
    const slides = $('.news-slide');
    let current = 0;

    function changeSlide(index) {
        // Убираем активный класс у всех и добавляем нужному
        slides.removeClass('active');
        $(slides[index]).addClass('active');
    }

    $('.next-news').on('click', function() {
        current = (current + 1) % slides.length;
        changeSlide(current);
    });

    $('.prev-news').on('click', function() {
        current = (current - 1 + slides.length) % slides.length;
        changeSlide(current);
    });
});