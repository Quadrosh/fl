$(document).ready(function() {




    //var  topForm = $('#quickorder_form_top');
    var  topForm = $('#divTopForm');
    var topFormHighlighted = false;
    var tlloop = new TimelineMax();

    function chekHasChanged() {
        var hasChanges = false;
        $(".form-control").each(function () {
            if (this.defaultValue != this.value) {
                if (!topFormHighlighted) {
                    topForm.addClass('dirty');
                    topFormHighlighted = true;
                    tlloop.kill();
                }
            }
        });
        return hasChanges;
    }

    topForm.mouseleave(function(){
        chekHasChanged();
    });

    topForm.on('touchend',function(){
        chekHasChanged();
    });
    topForm.on('keyup',function(){
        chekHasChanged();
    });


    //if (topForm.hasClass('dirty')) {
    //    alert('dirty');
    //}


    if (document.getElementById('topSection')) {
        var topSection = document.getElementById('topSection');
        var topBox = document.getElementById('topLoopBg');

        function changeBackground(){
            tlloop = new TimelineMax({repeat:50});

            tlloop.to(topBox,3,  {css:{ autoAlpha:0}, ease:Power0.easeNone}, "+=15");
            tlloop.set(topBox, {backgroundImage:'url(img/city1.jpg)'});
            tlloop.to(topBox,3,  {css:{ autoAlpha:1}, ease:Power0.easeNone}, "+=15");
            tlloop.set(topSection, {backgroundImage:'url(img/cityM.jpg)'});
            tlloop.to(topBox,3,  {css:{ autoAlpha:0}, ease:Power0.easeNone}, "+=15");
            tlloop.set(topBox, {backgroundImage:'url(img/city3.jpg)'});
            tlloop.to(topBox,3,  {css:{ autoAlpha:1}, ease:Power0.easeNone}, "+=20");
            tlloop.set(topSection, {backgroundImage:'url(img/mainCity.jpg)'});
            tlloop.to(topBox,3,  {css:{ autoAlpha:0}, ease:Power0.easeNone}, "+=15");
            ;

            if (topFormHighlighted) {
                alert('topFormHighlighted');
                tlloop.kill();
            }

        };
        changeBackground();
    }


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


    $("#quickorder_form_top").on("afterValidate", function () {
        yaCounter49048793.reachGoal("home_top_quickorder");
        //ga("send","event","feedback","call","call_me");
    });
    $("#tz_mainOrderForm").on("afterValidate", function () {
        yaCounter49048793.reachGoal("tz_preorder");
        //ga("send","event","feedback","call","call_me");
    });
    $("#bg_mainOrderForm").on("afterValidate", function () {
        yaCounter49048793.reachGoal("bg_preorder");
        //ga("send","event","feedback","call","call_me");
    });



    $("#tz_mainOrderForm-inn").on('change.yii',function(){

        if ($('#tz_mainOrderForm-inn').val().length > 10) {
            alert( 'Прием заявок от индивидуальных предпринимателей временно приостановлен.' );

        }

    });




});