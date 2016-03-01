/**
 * Created by Administrator on 2016/2/28.
 */
$(function(){
    //首页默认加载
    $("#content").attr("src","/app_index/showAllThing");
    //登录提交
    $("#login").click(function () {
        var user_name = $("#user_name").val();
        var user_pwd = $("user_pwd").val();
        $.ajax({
            type : "POST",
            url : "/app_index/login",
            data : {"user_name" : user_name, "user_pwd" : user_pwd},
            dataType: "json",
            success : function(data) {
                if (data.code==0) {
                    window.location.href = "/app_index/showThing";
                } else {
                    alert("登录失败");
                }
            }
        });
    });
});

//加载内容
function opencontent(url) {
    $("#content").attr("src",url);
}

function refresh() {
    window.location.reload();
}


