/**
 * Created by Administrator on 2016/2/28.
 */
$(function(){
    //首页默认加载
    $("#content").attr("src","/app_thing/showAllThing");
    //登录提交
    $("#login").click(function () {
        var user_name = $("#user_name").val();
        var user_pwd = $("#user_pwd").val();
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

    $("#exit").click(function () {
        window.location.href =  "/app_index/index";
    })
    //注册提交
    $("#register").click(function () {
        var user_name = $("#user_name").val();
        var user_pwd = $("#user_pwd").val();
        var user_sex = $('#user_sex').val();
        var user_email = $('#user_email').val();
        $.ajax({
            type : "POST",
            url : "/app_index/registerUser",
            data : {"user_name" : user_name, "user_pwd" : user_pwd, "user_sex" : user_sex, "user_email" : user_email},
            dataType: "json",
            success : function(data) {
                if (data.code==0) {
                    alert("注册成功，快去登录吧！");
                } else {
                    alert("注册失败");
                }
            }
        });
    });

    //点击去注册
    $("#goregister").click(function() {
        window.location.href = "/app_index/register";
    });

    //点击去登录
    $("#gologin").click(function() {
        window.location.href = "/app_index/index";
    });
});


//加载内容
function opencontent(url) {
    $("#content").attr("src",url);
}

function refresh() {
    window.location.reload();
}


