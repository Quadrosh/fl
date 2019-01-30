$(document).ready(function() {





    //if (topForm.hasClass('dirty')) {
    //    alert('dirty');
    //}




    $('.reviewsCarousel').slick({
        infinite: true,
        arrows: true,
        draggable: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        easing:'easeInOutSine',
        prevArrow:'.slickReviewsPrev',
        nextArrow:'.slickReviewsNext',
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ],
        //appendArrows:'.reviewsCarousel',
    })
    ;
    $('.caruMagLink').magnificPopup({
        type: 'image',
        image: {
            markup: '<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<div class="mfp-img"></div>'+
            '<div class="mfp-bottom-bar">'+
            '<div class="mfp-title"></div>'+
            '<div class="mfp-counter"></div>'+
            '</div>'+
            '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button

            cursor: null,
            verticalFit: false,

            tError: '<a href="%url%">Изображение</a> не может быть загружено.' // Error message
        },
        gallery: {
            enabled: false,
        },
        fixedContentPos: true,
        overflowY:true,
    });







});