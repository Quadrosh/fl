$(document).ready(function() {


    //тендерный займ
    $(".phoneForm_tender_zaim").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder_tz");
        ga("send","event","preorder","click","tz");
    });
    $(".mainOrderForm_tender_zaim").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder_tz");
        ga("send","event","preorder","click","tz");
    });


    // банковская гарантия
    $(".phoneForm_bank_garant").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder_bg");
        ga("send","event","preorder","click","bg");
    });
    $(".mainOrderForm_bank_garant").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder_bg");
        ga("send","event","preorder","click","bg");
    });


    // home and mixed
    $(".mainOrderForm_").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder");
        ga("send","event","preorder","click","mixed");
    });
    $(".phoneForm_").on("afterValidate", function () {
        yaCounter52091898.reachGoal("preorder");
        ga("send","event","preorder","click","mixed");
    });






    $("#tz_mainOrderForm-inn").on('change.yii',function(){

        if ($('#tz_mainOrderForm-inn').val().length > 10) {
            alert( 'Прием заявок от индивидуальных предпринимателей временно приостановлен.' );
        }
    });




});