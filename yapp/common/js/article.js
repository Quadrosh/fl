

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






    if (document.getElementById('bg_fun_calc_box')) {
        function bgFunCalc(){
            var dataObj =  document.getElementById('bg_fun_calc_box');

            var dataRate = dataObj?dataObj.getAttribute('data-rate'):null;
            var dataCode = dataObj?dataObj.getAttribute('data-code'):null;

            var factorsValue = 1;

            var start = 0;
            var minVal = 10000;
            var maxVal = 30000000;

            var timeStart = 1;
            var timeMinVal = 1;
            var timeMaxVal = 36;
            var interest_rate = dataRate;

            var startVal = 20000;

            var display = $("#current_val");
            var timeDisplay = $("#time_val");
            var commission = $("#commission_val");

            var contain = $("#slider_container");
            var timeContain = $("#time_slider_container");
            var containX = contain.offset().left;
            var containWidth = contain.width();
            var timeContainWidth = timeContain.width();

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
                cursor: "pointer"
            });

            Draggable.create(timeContain, {
                bounds: timeContain,
                cursor: "pointer"
            });

            var pin = Draggable.get("#slider_pin");
            var timePin = Draggable.get("#time_slider_pin");

            init(startVal,timeStart);
            initFz();
            initNoFz();
///////////

            function init(start,timeStart) {
                TweenLite.set(pin.target, { x: getPosition(start) });
                TweenLite.set(timePin.target, { x: getTimePosition(timeStart) });
                pin.update();
                timePin.update();
                updateRange();
            }

            function getValue(position) {
                var ratio = position / containWidth;
                return ((maxVal - minVal) * ratio) + minVal;
            }
            function getTimeValue(position) {
                var ratio = position / timeContainWidth;
                return ((timeMaxVal - timeMinVal) * ratio) + timeMinVal;
            }

            function getPosition(value) {
                var ratio = (value - minVal) / (maxVal - minVal);
                return (ratio * containWidth) - pinOffset;
            }
            function getTimePosition(value) {
                var ratio = (value - timeMinVal) / (timeMaxVal - timeMinVal);
                return (ratio * timeContainWidth) - pinOffset;
            }

            function getRange(handl) {
                var range = handl.x + pinOffset;
                range = range < 1
                    ? 0 : range > containWidth
                    ? containWidth : range;
                return range;
            }
            function getTimeRange(handl) {
                var range = handl.x + pinOffset;
                range = range < 1
                    ? 0 : range > timeContainWidth
                    ? timeContainWidth : range;
                return range;
            }

            function updateRange (){
                var range = getRange(pin);
                var timeRange = getTimeRange(timePin);
                summ_val = Math.round(getValue(range));
                time_val = Math.round(getTimeValue(timeRange));
                var fz = checkFz();
                commission_val = Math.round(summ_val / 100 * interest_rate*time_val*fz*factorsValue);
                TweenLite.set('.slider_range', { x: start, width: range });
                TweenLite.set('.time_slider_range', { x: start, width: timeRange });
                display.html(int_000(summ_val));
                timeDisplay.html(time_val);
                commission.html(int_000(commission_val));
            };

            function initFz() {
                var radioButtons = document.getElementsByName('fz');
                for (var i=0; i<radioButtons.length; i++) {
                    radioButtons[i].addEventListener('change', function(){
                        updateRange ();
                    });

                }
            }
            function checkFz() {
                var radioButtons = document.getElementsByName('fz');
                for (var i=0; i<radioButtons.length; i++) {

                    if (radioButtons[i].checked) {
                        return radioButtons[i].value;
                    }
                }
            }
            function initNoFz() {
                var checkBoxes = document.getElementsByName('noFz[]');
                for (var i=0; i<checkBoxes.length; i++) {
                    checkBoxes[i].addEventListener('change', function(){
                        if (this.checked) {
                            factorsValue = factorsValue * this.value;
                        } else {
                            factorsValue = factorsValue / this.value;
                        }
                        updateRange ();
                    });

                }
            }

        }
        bgFunCalc();
    }




    //  bg rotor calc
    if (document.getElementById('bg_rotor_calc_box')) {
        function bgRotorCalc(){
            var dataObj =  document.getElementById('bg_rotor_calc_box');

            var dataRate = dataObj?dataObj.getAttribute('data-rate'):null;
            var dataCode = dataObj?dataObj.getAttribute('data-code'):null;
            var dataOnly = dataObj?dataObj.getAttribute('data-only'):null;
            var dataOnlyRate = dataObj?dataObj.getAttribute('data-only-rate'):null;


            var factorsValue = 1;

            var minDeg = 40;
            var maxDeg = 320;
            var degRange = maxDeg-minDeg;


            var sumStart = 10000;
            var sumMinVal = 10000;
            var sumMaxVal = 30000000;

            var timeStart = 1;
            var timeMinVal = 1;
            var timeMaxVal = 36;
            var interest_rate = dataRate;


            var display = $("#current_val");
            var timeDisplay = $("#time_val");
            var commission = $("#commission_val");


            Draggable.create(".rotor_knob", {
                type: "rotation",
                cursor: "pointer",
                bounds:{minRotation:minDeg, maxRotation:maxDeg},
                onDrag : updateRange
            });


            var sumPin = Draggable.get("#summ_rotor_pin");
            var timePin = Draggable.get("#time_rotor_pin");


            init(sumStart,timeStart);
            if (!dataOnly) {
                initFz();
            }

            initNoFz();
/////////////
//
            function init(sumStart,timeStart) {
                TweenLite.set(sumPin.target, { rotation: minDeg+getSumPosition(sumStart) });
                TweenLite.set(timePin.target, { rotation: minDeg+getTimePosition(timeStart) });
                sumPin.update();
                timePin.update();
                updateRange();
            }

            function getSumValue(position) {
                var ratio = (position - minDeg) / degRange;
                return ((sumMaxVal - sumMinVal) * ratio) + sumMinVal;
            }
            function getTimeValue(position) {
                var ratio = (position - minDeg) / degRange;
                return ((timeMaxVal - timeMinVal) * ratio) + timeMinVal;
            }
//
            function getSumPosition(value) {
                var ratio = (value - sumMinVal) / (sumMaxVal - sumMinVal);
                return ratio * degRange;
            }
            function getTimePosition(value) {
                var ratio = (value - timeMinVal) / (timeMaxVal - timeMinVal);
                return ratio * degRange;
            }


            function updateRange (){
                summ_val = Math.round(getSumValue(sumPin.rotation));
                time_val = Math.round(getTimeValue(timePin.rotation));
                var fz = checkFz();
                commission_val = Math.round(summ_val / 100 * interest_rate*time_val*fz*factorsValue);
                display.html(int_000(summ_val));
                timeDisplay.html(time_val);
                commission.html(int_000(commission_val));

            };
//
            function initFz() {
                var radioButtons = document.getElementsByName('fz');
                for (var i=0; i<radioButtons.length; i++) {
                    radioButtons[i].addEventListener('change', function(){
                        updateRange ();
                    });

                }
            }
            function checkFz() {
                if (!dataOnly) {
                    var radioButtons = document.getElementsByName('fz');
                    for (var i=0; i<radioButtons.length; i++) {
                        if (radioButtons[i].checked) {
                            return radioButtons[i].value;
                        }
                    }
                } else {
                    return dataOnlyRate;
                }

            }
            function initNoFz() {
                var checkBoxes = document.getElementsByName('noFz[]');
                for (var i=0; i<checkBoxes.length; i++) {
                    checkBoxes[i].addEventListener('change', function(){
                        if (this.checked) {
                            factorsValue = factorsValue * this.value;
                        } else {
                            factorsValue = factorsValue / this.value;
                        }
                        updateRange ();
                    });

                }
            }

        }
        bgRotorCalc();
    }

    //  !bg rotor calc







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

    if (document.getElementsByClassName('slickMulti')) {
        var arr = document.getElementsByClassName('slickMulti');

        for (var i = 0; i < arr.length; i++) {
            var id = arr[i].getAttribute('data-id');
            var showItems = arr[i].getAttribute('data-showItems')? arr[i].getAttribute('data-showItems'):1;
            slick(id,showItems);
        }

        function slick(id,show) {
            $('.slick_multi_'+id).slick({
                infinite: true,
                slidesToShow: show,
                slidesToScroll: 1,
                dots: false,
                easing:'easeInOutSine',
                prevArrow:'.slickPrev'+id,
                nextArrow:'.slickNext'+id,
                responsive: [
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
    }

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





//function processResponse(data){
//
//    for (var i = 0; i < data.length; i++){
//        var obj = data[i];
//
//        console.log(obj);
//
//    }
//}