$(function () {
    //头部轮播图
    $("#myCarousel").hover(function () {
        $("#prev").show()
        $("#next").show()
    },function () {
        $("#prev").hide()
        $("#next").hide()
    })
    $("#myCarousel").carousel({interval:3000})
    $("#prev").click(function () {
        $("#myCarousel").carousel('prev')
    })
    $("#next").click(function () {
        $("#myCarousel").carousel('next')
    })
    $(".carousel-indicators li").click(function () {
           $("#myCarousel").carousel($(this).index())
    })
    var i=0;
    var timer=null;
    var firtporject=$("#bigporject .project").first().clone()//复制第一个项目
    $(".son").append(firtporject).width($("#bigporject .project").length*($("#bigporject .project").width()))
    //下一个按钮
    $("#bigporject #button-right").click(function () {
        i++
        console.log($("#bigporject .project").length)
        if(i==$("#bigporject .project").length){
            i=1;
            $(".son").css("left","0")
        }
        $(".son").stop().animate({"left":-i*1000+"px"},500)
        $(".bottomstyle").eq(i).find("p").addClass("active")
        $(".bottomstyle").eq(i).find("span").addClass("active1")
        $(".bottomstyle").eq(i).siblings().find("p").removeClass("active")
        $(".bottomstyle").eq(i).siblings().find("span").removeClass("active1")
        if(i==4){
            $(".bottomstyle").eq(0).find("p").addClass("active")
            $(".bottomstyle").eq(0).find("span").addClass("active1")
            $(".bottomstyle").eq(0).siblings().find("p").removeClass("active")
            $(".bottomstyle").eq(0).siblings().find("span").removeClass("active1")
        }
    })
    //上一个按钮
    $("#button-left").click(function () {
        i--
        if(i==-1){
            i=$("#bigporject .project").length-2
            $(".son").css({"left":-($("#bigporject .project").length-1)*1000+"px"})
        }
        $(".son").stop().animate({"left":-i*1000+"px"})
        $(".bottomstyle").eq(i).find("p").addClass("active")
        $(".bottomstyle").eq(i).find("span").addClass("active1")
        $(".bottomstyle").eq(i).siblings().find("p").removeClass("active")
        $(".bottomstyle").eq(i).siblings().find("span").removeClass("active1")
    })
    //设置按钮显示隐藏,鼠标放上去停止轮播
    $("#button-left").hide()
    $("#button-right").hide()
    $("#bigporject").hover(function () {
        clearInterval(timer)
        $("#button-left").show()
        $("#button-right").show()
    },function () {
        $("#button-left").hide()
        $("#button-right").hide()
        timer=setInterval(function () {
            i++
            if(i==$("#bigporject .project").length){
                i=1;
                $(".son").css("left","0")
            }
            $(".son").stop().animate({"left":-i*1000+"px"},500)
            $(".bottomstyle").eq(i).find("p").addClass("active")
            $(".bottomstyle").eq(i).find("span").addClass("active1")
            $(".bottomstyle").eq(i).siblings().find("p").removeClass("active")
            $(".bottomstyle").eq(i).siblings().find("span").removeClass("active1")
            if(i==4){
                $(".bottomstyle").eq(0).find("p").addClass("active")
                $(".bottomstyle").eq(0).find("span").addClass("active1")
                $(".bottomstyle").eq(0).siblings().find("p").removeClass("active")
                $(".bottomstyle").eq(0).siblings().find("span").removeClass("active1")
            }
        },3500)
    })
    //自动轮播
    timer=setInterval(function () {
        i++
        if(i==$("#bigporject .project").length){
            i=1;
            $(".son").css("left","0")
        }
        $(".son").stop().animate({"left":-i*1000+"px"},500)
        $(".bottomstyle").eq(i).find("p").addClass("active")
        $(".bottomstyle").eq(i).find("span").addClass("active1")
        $(".bottomstyle").eq(i).siblings().find("p").removeClass("active")
        $(".bottomstyle").eq(i).siblings().find("span").removeClass("active1")
        if(i==4){
            $(".bottomstyle").eq(0).find("p").addClass("active")
            $(".bottomstyle").eq(0).find("span").addClass("active1")
            $(".bottomstyle").eq(0).siblings().find("p").removeClass("active")
            $(".bottomstyle").eq(0).siblings().find("span").removeClass("active1")
        }
    },3500)
    //点击专题效果
    $(".bottomstyle").click(function () {
        var j= $(this).index()
        $(".son").stop().animate({"left":-j*1000+"px"},500)
        $(".bottomstyle").eq(j).find("p").addClass("active")
        $(".bottomstyle").eq(j).find("span").addClass("active1")
        $(".bottomstyle").eq(j).siblings().find("p").removeClass("active")
        $(".bottomstyle").eq(j).siblings().find("span").removeClass("active1")
    })


})