$(document).ready(function() {

    $("#quickorder_form_top").on("afterValidate", function () {
        yaCounter49048793.reachGoal("home_top_quickorder");
        ga("send","event","quickform","click","face_quickform");
    });
    $("#tz_mainOrderForm").on("afterValidate", function () {
        yaCounter49048793.reachGoal("tz_preorder");
        ga("send","event","preorder","click","tz");
    });
    $("#bg_mainOrderForm").on("afterValidate", function () {
        yaCounter49048793.reachGoal("bg_preorder");
        ga("send","event","preorder","click","bg");
    });

    $("#tz_mainOrderForm-inn").on('change.yii',function(){

        if ($('#tz_mainOrderForm-inn').val().length > 10) {
            alert( 'Прием заявок от индивидуальных предпринимателей временно приостановлен.' );
        }
    });

});