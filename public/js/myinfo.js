/**
 * Created by Administrator on 2016/4/17.
 */
$(function() {
    var update_type;
    //设置弹窗隐藏
    $("#change").dialog({
        closed : true
    });
    $("#changeSex").dialog({
        closed : true
    });
    $("#addThing").dialog({
        closed : true
    });

    $("#sendMessage").dialog({
        closed : true
    });


    //点击修改昵称
    $("#user_name").click(function() {
        changeTitle('修改昵称','请输入新昵称',1);
        update_type = 'user_name';
        $('#change').dialog('open').dialog('center');
    });

    //点击打开发表观点的面板
    $("#addThingBtn").click(function() {
        $("#addThing").dialog({
            title : "发表评论"
        });
        $('#addThing').dialog('open').dialog('center');
    });

    //点击修改性别
    $("#user_sex").click(function() {
        changeTitle('修改性别','请选择你的性别',2);
        update_type = 'user_sex';
        $('#changeSex').dialog('open').dialog('center');
    });

    //点击修改头像
    $("#user_head").click(function() {
        changeTitle('修改头像','请选择头像',1);
        update_type = 'user_head';
        $('#changeSex').dialog('open').dialog('center');
    });

    //点击修改邮箱
    $("#user_email").click(function() {
        changeTitle('修改邮箱','请输入新邮箱',1);
        update_type = 'user_email';
        $('#change').dialog('open').dialog('center');
    });
    //更新信息
    $('.update').on('click', function (){
        if (update_type == 'user_sex') {
            var value = $('#selectSex').combobox('getValue');
        } else {
            var value = $('.inputval').val();
        }
        $.ajax({
            url: '/app_index/updateUser',
            type: "POST",
            dataType: "json",
            data: {update_type:update_type,value:value},
            success: function(res) {
                console.log(res );
                if (res.code==0) {
                    alert('更新成功');
                    window.location.reload();
                } else {
                    alert('更新失败');
                }
            }
        });
    });

    //发表观点
    $('#fb').on('click', function(){
        var thing_content = $('#thing_content').val();
        $.ajax({
            url: '/app_thing/addThing',
            type: "POST",
            dataType: "json",
            data: {thing_content:thing_content},
            success: function(res) {
                if (res.code==0) {
                    alert(res.msg);
                    window.location.reload();
                } else {
                    alert(res.msg);
                }
            }
        });
    })
});

function changeTitle(title,pro,type) {
    if(type==1) {
        $("#change").dialog({
            title : title
        });
    }else if(type==2) {
        $("#changeSex").dialog({
            title : title
        });
    }

    $('.easyui-textbox.text').textbox({
        prompt : pro
    });
}
