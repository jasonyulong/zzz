$(function () {
    $(".pro button").click(function () {
        $(this).addClass("active")
        $(this).siblings().removeClass("active")
    })
    $(".query button").click(function () {
        $(this).addClass("active1")
        $(this).siblings().removeClass("active1")
    })
    $(".query button").click(function () {
       var $index = $(this).index()
        if($index == 0){
           location.href="/user/index/askadd.html"
        }
        if($index == 1){
           location.href="/user/index/ask.html"
        }
        if($index == 2){
           location.href="/user/cang/article.html"
        }
    })
    sub()
    var num=2
    $(".morenews").click(function () {
	    var a=$("#url").val()
        num++
        $.ajax({
            type:"get",
            url:a+num+".html",
            data:num,
            datatype:"json",
            success:function (date) {
                if(date==""){
                    $(".morenews").html("没有更多回答了")
                }
                $.each(date,function (idx,obj) {
                    console.log($.isEmptyObject(obj))
                    var title=obj.title;
                    var src= obj.re_face
                    var content=obj.re_content
                    $(".morenews").before("<div class=\"project\" >\n" +
                        "            <p><img class=\"img\" src=\""+obj.re_face+"\"><span>"+obj.re_name+"</span></p>\n" +
                        "            <a href=\""+obj.url+"\">\n" +
                        "                <h2>"+obj.title+"</h2>\n" +
                        "                <div>"+obj.re_content+"</div>\n" +
                        "            </a>\n" +
                        "            <b>浏览："+obj.look+"&nbsp;&nbsp;&nbsp;&nbsp;评论："+obj.ans_sum+"</b>\n" +
                        "        </div>")
                })
            }
        })
        sub()

    })
    function sub() {
        for (i=0;i<$(".project div").length;i++){
            var text;
            if ($(".project div").eq(i).text().length>50){
                text=$(".project div").eq(i).text().substring(0,50)+"......"
                $(".project div").eq(i).text(text)
                $(".project div").eq(i).append("<span >&nbsp; &nbsp;阅读全文>")
            }else if($(".project div").eq(i).text().length == 0){
                $(".project div").eq(i).text("暂无回答")
            }
        }
        for (i=0;i<$(".project h2").length;i++){
            var text1;
            if ($(".project h2").eq(i).text().length>50){
                text1=$(".project h2").eq(i).text().substring(0,50)+"......"
                $(".project h2").eq(i).text(text1)
            }

        }
    }
})

