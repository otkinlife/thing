/**
 * Created by jkc on 2016/2/2.
 */
var type;
var url;
var row;

$(function(){
    //加载数据表格
    $('#dg').datagrid({
        fit:true,
        method:'GET',
        toolbar: '#tb',
        url:"/admin_index/getUsersList",
        pagination:true,
        singleSelect: true,
        columns:[[
            {field:'id',title:'编号',width:"20%"},
            {field:'user_name',title:'姓名',width:"20%"},
            {field:'user_email',title:'电子邮箱',width:"20%"},
            {field:'user_sex',title:'性别',width:"20%"},
            {field:'is_admin',title:'是否管理员',width:"20%"},
        ]]
    });

    //加载搜索框
    $('#ss').searchbox({
        searcher:function(value) {
            $('#dg').datagrid({
                fit:true,
                method:'GET',
                toolbar: '#tb',
                url:"/admin_index/findUser?keyword="+value,
                pagination:true,
                singleSelect: true,
                columns:[[
                    {field:'id',title:'编号',width:"20%"},
                    {field:'user_name',title:'姓名',width:"20%"},
                    {field:'user_email',title:'电子邮箱',width:"20%"},
                    {field:'user_sex',title:'性别',width:"20%"},
                    {field:'is_admin',title:'是否管理员',width:"20%"}
                ]]
            });
        }
    });

    //加载增加业主的弹窗
    $('#dlg').dialog({
        title:"增加业主",
        width:300,
        height:345,
        closed:true
    });

    //增加按钮
    $('#add_btn').click(function(){
        type = 1;
        $('#dlg').dialog('open');
        $('#fm').form('clear');
    });

    //编辑按钮
    $('#edit_btn').click(function () {
        type = 2;
        row = $('#dg').datagrid('getSelected');
        $('#fm').form('clear');
        if (row){
            $('#fm').form('load', {"id":row["id"]});
            $('#fm').form('load', {"user_name":row["user_name"]});
            $('#fm').form('load', {"user_email":row["user_email"]});
            $('#fm').form('load', {"user_sex":row["user_sex"]});
            $('#fm').form('load', {"is_admin":row["is_admin"]});
            $('#dlg').dialog('open');
        }
        return ;

    });

    $('#rm_btn').click(function(){
        row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('系统提示','你确定要删除吗',function(r){
                if(r){
                    $.ajax({
                        type: "GET",
                        url: "/admin_index/removeUser",
                        data: {id: row.id},
                        dataType: "json",
                        success: function (data) {
                            if (data.code==0){
                                $('#dg').datagrid('reload');
                                $.messager.show({
                                    title: '成功',
                                    msg: data.msg
                                });
                            } else {
                                $.messager.show({
                                    title: '错误r',
                                    msg: data.msg
                                });
                            }
                        }
                    })
                }
            });
        }
    });

    //提交按钮
    $('#sbt').click(function(){
        var data;
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var user_sex = $('#user_sex').val();
        var is_admin = $('#is_admin').val();
        var user_pwd = $('#user_pwd').val();
        if(row) {
             data = {
                'id':row.id,
                'user_name':user_name,
                'user_email':user_email,
                'user_sex':user_sex,
                'is_admin':is_admin,
                'user_pwd':user_pwd
            };
        } else {
            data = {
                'user_name':user_name,
                'user_email':user_email,
                'user_sex':user_sex,
                'is_admin':is_admin,
                'user_pwd':user_pwd
            };
        }

        if(type == 1){
            url = '/admin_index/insertUser';
            save(data);
        }else {
            url = '/admin_index/updateUser';
            save(data);
        }
    });
});


//提交函数
function save(data){
    $.ajax({
        url: url,
        type:'POST',
        data:data,
        success: function(result){
            $('#dlg').dialog('close');
            var result = eval('('+result+')');
            if (result.code==0){
                $('#dg').datagrid('reload');
                $.messager.show({
                    title: '成功',
                    msg: result.msg
                });
            } else {
                $.messager.show({
                    title: '错误',
                    msg: result.msg
                });
            }
        }
    });
}