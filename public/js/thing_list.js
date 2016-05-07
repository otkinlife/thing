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
        url: "/admin_thing/getThingList",
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
                url: "/admin_thing/findThing?pass=1&keyword="+value,
                pagination: true,
                singleSelect: true,
                columns: [[
                    {field: 'thing_id', title: '编号', width: "20%"},
                    {field: 'thing_content', title: '趣事内容', width: "40%"},
                    {field: 'user_id', title: '发表者', width: "20%"},
                    {field: 'create_time', title: '发表时间', width: "20%"}
                ]]
            });
        }
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
})
