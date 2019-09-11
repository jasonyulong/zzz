$(function () {
    //侧边栏
    //评论输入框获得焦点
    $("#comment").focus(function () {
        $(this).addClass("focus")
    })
    $("#nav-tips div").eq(0).click(function () {
        var login=$("#fuislogin").val()
        if(login=="yes"){
            window.location.href="/user/index/index.html"
        }
        if(login=="no"){
            window.location.href="/userlogin.html"
        }
    })
    $("#nav-tips div").eq(1).click(function () {
        window.location.href="tencent://message/?uin=3429586531&Site=http://vps.shuidazhe.com&Menu=yes"
    })
    $("#nav-tips div").eq(4).click(function () {
        $('body,html').animate({scrollTop:0},$(window).scrollTop()/4);
    })
    $("#nav-tips div").eq(2).hover(function () {
        $("#gong").show()
    },function () {
        $("#gong").hide()
    })
    $("#window div").eq(0).click(function () {
        $(window).scrollTop(0)
    })
    $("#window div").eq(1).click(function () {
        $(window).scrollTop(1000)
    })
    $("#window div").eq(2).click(function () {
        $(window).scrollTop(2600)
    })
    $(document).on("scroll",function () {
        if(600 > parseInt($(window).scrollTop()) > 0){
            $("#window div").eq(0).addClass("scrool")
            $("#window div").eq(0).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop()) > 600){
            $("#window div").eq(1).addClass("scrool")
            $("#window div").eq(1).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop())>1600){
            $("#window div").eq(2).addClass("scrool")
            $("#window div").eq(2).siblings().removeClass("scrool")
        }
    })
})