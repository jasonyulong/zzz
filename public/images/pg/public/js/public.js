$(function () {
    //侧边栏
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
})