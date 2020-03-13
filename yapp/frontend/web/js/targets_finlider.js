$(document).ready(function() {

    var serviceTypeIndicator = $(".service_type_indicator");
    var serviceType = serviceTypeIndicator.length>0?serviceTypeIndicator[0].value:null;

    $("#quickorder_form_top").on("afterValidate", function () {
        findServiceType();
    });

    $("#tz_mainOrderForm").on("afterValidate", function () {
        tzPreorderTargetDone();
    });

    $("#bg_mainOrderForm").on("afterValidate", function () {
        bgPreorderTargetDone();
    });

    $("#mainOrderForm").on("afterValidate", function () {
        findServiceType();
    });

    $(".form-horizontal").on("afterValidate", function () {
        findServiceType();
    });


    function findServiceType(){
        if (serviceType=='bank_garant') {
            bgPreorderTargetDone();
        } else if (serviceType=='tender_zaim'){
            tzPreorderTargetDone();
        } else {
            notSetServiceTypeTargetDone();
        }
    }

    function tzPreorderTargetDone(){
        if (window.location.hostname!='finlider.local') {
            yaCounter49048793.reachGoal("tz_preorder");
            ga("send","event","preorder","click","tz");
        } else {
            console.log('local host, target tzPreorderTargetDone()')
        }
    }

    function bgPreorderTargetDone(){
        if (window.location.hostname!='finlider.local') {
            yaCounter49048793.reachGoal("bg_preorder");
            ga("send","event","preorder","click","bg");
        } else {
            console.log('local host, target bgPreorderTargetDone()')
        }
    }

    function notSetServiceTypeTargetDone(){
        if (window.location.hostname!='finlider.local') {
            yaCounter49048793.reachGoal("preorder");
            ga("send","event","preorder","click","common");
        } else {
            console.log('local host, target notSetServiceTypeTargetDone()')
        }
    }



    $("#tz_mainOrderForm-inn").on('change.yii',function(){

        if ($('#tz_mainOrderForm-inn').val().length > 10) {
            alert( 'Прием заявок от индивидуальных предпринимателей временно приостановлен.' );
        }
    });

});