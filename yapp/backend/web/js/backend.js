window.onload = function(){

    $("#getHrurlFromArticleListname").on("click", function () {
        $.ajax({
            url: "/article/hrurl",
            dataType: "html",
            data: {
                text: $("#article-list_name").val(),
                length:210,
                toLowerCase:true,
                articleId:$("#getHrurlFromArticleListname").data('modelId'),
            },
            success: function(data){
                $("#article-hrurl").val(data);
            },
            error: function () {
                alert('Не получилось');
            }
        });

    });



};


