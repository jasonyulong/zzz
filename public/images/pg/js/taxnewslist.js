$(function () {
    var id=$("#id").val()
    var num=1
    page()
    function page() {
        $.post("/index/article/info_json_say.html", { id: id,page:num},
            function(data){
                if ((data.list[0]) == undefined) {
                    $(".morenews").html("没有更多了")
                }
                var list=new Array(data.list)
                array1=JSON.stringify(list[0])
                list[0].forEach(function(value,index){
                    $(".morenews").before("<div class=\"asnlist\">\n" +
                        "            <img width=\"50\" height=\"50\" src=\""+value.re_face+"\">\n" +
                        "            <div class=\"anspro\">\n" +
                        "                <p>"+value.re_name+" <span>"+value.time_ch+"</span></p>\n" +
                        "                <div>"+value.content+"</div>\n" +
                        "                <button>回复</button>\n" +
                        "                <input type=\"hidden\"  value=\""+value.id+"\" >\n" +
                        "                <button class=\"_pro\">"+value.zan+"</button>\n" +
                        "            </div>\n" +
                        "        </div>")
                })
            });
    }
    //点击加载更多
    $(".morenews").click(function () {
        num++
        page()
    })
    //点击回复
    //回复
    $(document).on("click",".anspro button:first-of-type",function () {
        $("#comment").val("@"+$(this).siblings().eq(0).text().split(" ")[0])
        location.href="#comment1"
        $("#comment").focus()
    })
    //评论点赞
    $(document).on("click","._pro",function () {
        var i = $(this).prev().val()
        var status;
        $(this).toggleClass("hover")
        if($(this).hasClass("hover")){
            status="add"
            $(this).html( parseInt($(this).html())+1)
        }else{
            status="delete"
            $(this).html(parseInt($(this).html())-1)
        }
        $.post("/index/article/info_json_repzan.html", { id:i,type: status});
    })
    //评论输入框获得焦点
    $("#comment").focus(function () {
        $(this).addClass("focus")
    })
    $("#comment").blur(function () {
        $(this).val("")
    })
    //左侧悬浮栏
    $(".news-left .projects").click(function () {
        var $index=$(this).index()
        switch ($index){
            case 4:
                location.href="#comment1"
                $("#comment").focus()
                break;
            case 5:
                var login=$("#islogin").val()
                if(login == "no"){
                    if(confirm("未登录是否跳转")){
                        location.href="/userlogin.html"
                    }
                }else {
                    $.post("http://www.qzw.com/index/article/info_json_cang.html", {id: id},
                        function (data) {
                            if (data.return == 1) {
                                alert("收藏成功")
                                $(this).find("strong").html("<strong style=\"color: #FE6F40;font-weight: 600\">&nbsp; &nbsp;点赞</strong>")
                            }
                            if (data.return == 0) {
                                alert(data.err)
                            }
                        });
                }
                break;
            case 6:
                var type;
                $(this).find("strong").toggleClass("zan")
                if($(this).find("strong").hasClass("zan")){
                    type="add"
                }else{
                    type="delete"
                }
                $.post("http://www.qzw.com/index/article/info_json_zan.html", { id:id,type: type},
                    function (date) {
                        console.log((date.return) == 0)
                        if((date.return)==1){
                            alert("点赞成功")
                        }else if((date.return) == 0){
                            if(confirm(date.err+"是否登录")){
                                location.href="/userlogin.html"
                            }
                        }
                    });
                break;
        }
    })
})