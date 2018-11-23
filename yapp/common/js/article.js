

$(document).ready(function() {

    //
    //$("#services-call2action").on("afterValidate", function () {
    //    yaCounter30134129.reachGoal("callMe");
    //    ga("send","event","feedback","call","callMe");
    //});





    //    gsap  range  slider   https://codepen.io/breheny/pen/zxMWxd



    function int_000(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }
    //  my slider
    if (document.getElementById('tz_calc_box')) {
        function tzCalc(){
            var dataObj =  document.getElementById('tz_calc_box');

            var dataRate = dataObj? dataObj.getAttribute('data-rate'):null;


            var start = 0;
            var minVal = 10000;
            var maxVal = 30000000;
            //var interest_rate = 3.8;
            var interest_rate = dataRate;

            var startVal = 80;

            var display = $("#current_val");
            var commission = $("#commission_val");

            var contain = $("#slider_container");
            var containX = contain.offset().left;
            var containWidth = contain.width();

            var pinWidth = $(".pin").outerWidth();
            var pinOffset = pinWidth / 2;

            Draggable.create(".pin", {
                type: "x",
                bounds: { left: -pinOffset, width: containWidth + pinWidth },
                cursor: "pointer",
                onDrag : updateRange
            });

            Draggable.create(contain, {
                bounds: contain,
                cursor: "pointer",
                onPress: setKnob
            });

            var pin = Draggable.get("#slider_pin");

            init(startVal);
///////////

            function init(start) {
                TweenLite.set(pin.target, { x: getPosition(start) });
                pin.update();
                updateRange();
            }

            function getValue(position) {
                var ratio = position / containWidth;
                return ((maxVal - minVal) * ratio) + minVal;
            }

            function getPosition(value) {
                var ratio = (value - minVal) / (maxVal - minVal);
                return (ratio * containWidth) - pinOffset;
            }

            function setKnob(event) {
                if (event.target === pin.target) {
                    return
                };
                mouseX = this.pointerX - containX;

                // Select the closest knob
                var handle = pin;

                TweenLite.set(handle.target, {
                    x: mouseX - pinOffset,
                    onComplete: function() {
                        handle.startDrag(event);
                    }});

                updateRange();
            }

            function getRange(handl) {
                var range = handl.x + pinOffset;
                range = range < 1
                    ? 0 : range > containWidth
                    ? containWidth : range;
                return range;
            }

            function updateRange (){
                var range = getRange(pin);
                summ_val = Math.round(getValue(range));
                commission_val = Math.round(summ_val / 100 * interest_rate);
                TweenLite.set('.slider_range', { x: start, width: range });
                display.html(int_000(summ_val));
                commission.html(int_000(commission_val));
            };
        }
        tzCalc();
    }









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