

$(document).ready(function() {

    //
    //$("#services-call2action").on("afterValidate", function () {
    //    yaCounter30134129.reachGoal("callMe");
    //    ga("send","event","feedback","call","callMe");
    //});


    $('.asb-slick_banner_1_carousel').slick({
        infinite: true,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        easing:'easeInOutSine',
        prevArrow:'.asb-slick_banner_1_slickPrev',
        nextArrow:'.asb-slick_banner_1_slickNext',
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
        //appendArrows:'.popularItems',
    });

});

$(document).on("beforeSubmit", "#mainBgCalculator", function () {
    var form = $(this);
    if (form.find('.has-error').length) {
        return false;
    }
    $.ajax({
        url    : form.attr('action'),
        type   : 'post',
        data   : form.serialize(),
        success: function (response)
        {
            var calcResult = $('#calculatorResult');
            calcResult.addClass('response');
            calcResult.html(response);
            //console.log(response);
        },
        error  : function ()
        {
            console.log('internal server error');
        }
        });
    return false; // Cancel form submitting.
});