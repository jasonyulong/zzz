$(function () {
    var id=$("#id").val()
    var num=1
    $.post("/index/pro/info_json_say.html", { id: id,page:num},
        function(data){
            var list=new Array(data.list)
            for (i=0;i<list.length;i++){
                $(".morenews").before("<div class=\"asnlist\">\n" +
                    "            <img width=\"50\" height=\"50\" src=\""+(data.list[i]).re_face+"\">\n" +
                    "            <div class=\"anspro\">\n" +
                    "                <p>"+(data.list[i]).re_name+" <span>"+(data.list[i]).tiem_ch+"</span></p>\n" +
                    "                <div>"+(data.list[i]).content+"</div>\n" +
                    "                <button>回复</button>\n" +
                    "                <input type=\"hidden\"  value=\""+(data.list[i]).id+"\" >\n" +
                    "                <button class=\"_pro\" >"+(data.list[i]).zan+"</button>\n" +
                    "            </div>\n" +
                    "        </div>")
            }
        });
    //点击加载更多
    $(".morenews").click(function () {
        num++
        $.post("/index/pro/info_json_say.html", { id: id,page:num},
            function(data){
                   if(data==""){
                        $(this).html("没有更多了")
                   }
                var list=new Array(data.list)
                console.log((data.list[0]).re_face)
                console.log(list.length)
                for (i=0;i<list.length;i++){
                    $(".morenews").before("<div class=\"asnlist\">\n" +
                        "            <img width=\"50\" height=\"50\" src=\""+(data.list[i]).re_face+"\">\n" +
                        "            <div class=\"anspro\">\n" +
                        "                <p>"+(data.list[i]).re_name+" <span>(data.list[i]).tiem_ch</span></p>\n" +
                        "                <div>"+(data.list[i]).content+"</div>\n" +
                        "                <button>回复</button>\n" +
                        "                <input type=\"hidden\"  value=\""+(data.list[i]).id+"\" >\n" +
                        "                <button class=\"_pro\">"+(data.list[i]).zan+"</button>\n" +
                        "            </div>\n" +
                        "        </div>")
                }
            });
    })
    //评论输入框获得焦点
    $("#comment").focus(function () {
        $(this).addClass("focus")
    })
    //点赞
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
        $.post("http://www.qzw.com/index/pro/info_json_repzan.html", { id:i,type: status});
    })
    //左侧悬浮栏
    $(".news-left .projects").click(function () {
        var $index=($(this).index())
        alert($index)
        switch ($index){
            case 2:
                location.href="#comment1"
                $("#comment").focus()
            break;
            case 3:
                var login=$("#islogin").val()
                if(login == "no"){
                    if(confirm("为登录是否跳转")){
                        location.href="login.heml"
                    }
                }else {
                    $.post("http://www.qzw.com/index/pro/info_json_cang.html", {id: id},
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
            case 4:
                var type;
                $(this).find("strong").toggleClass("zan")
                if($(this).find("strong").hasClass("zan")){
                    type="add"
                }else{
                    type="delete"
                }
                var id=$("#id").val()
                $.post("http://www.qzw.com/index/pro/info_json_zan.html", { id:id,type: type},
                    function (date) {
                        if(data.return==0){
                            alert("点赞成功")
                        }else{
                            alert(date.err)
                        }
                    });
            break;
        }
    })
})