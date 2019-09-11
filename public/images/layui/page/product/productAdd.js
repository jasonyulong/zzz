layui.config({
    base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
    var form = layui.form(),
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        laypage = layui.laypage,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery;

    //创建一个编辑器
    var editIndex = layedit.build('news_content');
    var addNewsArray = [],addNews;
    //查询
    $(".layui-btn").click(function(){

        var addpro=$("#addpro").val();
        if(addpro == ""){
            layer.msg("必填项不能为空");
        }
    })
    form.on("submit(addNews)",function(data){
        //是否添加过信息
        if(window.sessionStorage.getItem("addNews")){
            addNewsArray = JSON.parse(window.sessionStorage.getItem("addNews"));
        }
        //显示、审核状态
        var isShow = data.field.show=="on" ? "checked" : "",
            newsStatus = data.field.shenhe=="on" ? "审核通过" : "待审核";

    })

})
