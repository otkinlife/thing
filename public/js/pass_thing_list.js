/**
 * Created by jkc on 2016/2/2.
 */
var type;
var url;
var row;

$(function() {
    //加载数据表格
    $('#dg').datagrid({
        fit: true,
        method: 'GET',
        toolbar: '#tb',
        url: "/admin_thing/getPassThingList",
        pagination: true,
        singleSelect: true,
        columns: [[
            {field: 'thing_id', title: '编号', width: "20%"},
            {field: 'thing_content', title: '趣事内容', width: "40%"},
            {field: 'user_id', title: '发表者', width: "20%"},
            {field: 'create_time', title: '发表时间', width: "20%"}
        ]]
    });

    //加载搜索框
    $('#ss').searchbox({
        searcher: function (value) {
            $('#dg').datagrid({
                fit: true,
                method: 'GET',
                toolbar: '#tb',
                url: "/admin_thing/findThing?&keyword="+value,
                pagination: true,
                singleSelect: true,
                columns: [[
                    {field: 'thing_id', title: '编号', width: "20%"},
                    {field: 'thing_content', title: '趣事内容', width: "30%"},
                    {field: 'user_id', title: '发表者', width: "20%"},
                    {field: 'create_time', title: '发表时间', width: "20%"}
                ]]
            });
        }
    });

    //加载弹窗
    $('#dlg').dialog({
        title:"趣事详情",
        width:400,
        height:345,
        closed:true
    });

    $('#rm_btn').click(function () {
        row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('系统提示', '你确定要删除吗', function (r) {
                if (r) {
                    $.ajax({
                        type: "POST",
                        url: "/admin_thing/removeThing",
                        data: {thing_id: row.thing_id},
                        dataType: "json",
                        success: function (data) {
                            if (data.code == 0) {
                                $('#dg').datagrid('reload');
                                $.messager.show({
                                    title: '成功',
                                    msg: '删除趣事成功'
                                });
                            } else {
                                $.messager.show({
                                    title: '错误',
                                    msg: '删除趣事失败'
                                });
                            }
                        }
                    })
                }
            });
        }
    });

    $('#pass_btn').click(function () {
        row = $('#dg').datagrid('getSelected');
        $('#fm').form('clear');
        if (row){
            $('#create_time').html(row['create_time']);
            $('#user_id').html(row['user_id']);
            $('#thing_content').html(row['thing_content']);
            $('#dlg').dialog('open');
        }
        return ;
    });

    $('#sbt').click(function () {
        row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('系统提示', '点击确定通过审核', function (r) {
                if (r) {
                    $.ajax({
                        type: "POST",
                        url: "/admin_thing/passThing",
                        data: {thing_id: row.thing_id},
                        dataType: "json",
                        success: function (data) {
                            if (data.code == 0) {
                                $('#dg').datagrid('reload');
                                $.messager.show({
                                    title: '成功',
                                    msg: '该趣事已审核通过'
                                });
                            } else {
                                $.messager.show({
                                    title: '错误',
                                    msg: '该趣事审核失败'
                                });
                            }
                        }
                    })
                }
            });
        }
    });

})
