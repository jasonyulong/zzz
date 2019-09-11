$(function () {
    $("#window div").eq(0).click(function () {
        $(window).scrollTop(0)
    })
    $("#window div").eq(1).click(function () {
        $(window).scrollTop(1000)
    })
    $("#window div").eq(2).click(function () {
        $(window).scrollTop(1990)
    })
    $("#window div").eq(3).click(function () {
        $(window).scrollTop(2977)
    })
    $(document).on("scroll",function () {

        console.log($(window).scrollTop())
        if(parseInt($(window).scrollTop())>600){
            $("#window div").eq(1).addClass("scrool")
            $("#window div").eq(1).siblings().removeClass("scrool")
        }else {
            $("#window div").eq(0).addClass("scrool")
            $("#window div").eq(0).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop())>600){
            $("#window div").eq(1).addClass("scrool")
            $("#window div").eq(1).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop())>1500){
            $("#window div").eq(2).addClass("scrool")
            $("#window div").eq(2).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop())>2500){
            $("#window div").eq(3).addClass("scrool")
            $("#window div").eq(3).siblings().removeClass("scrool")
        }
        if(parseInt($(window).scrollTop())>2500){
            $("#window div").eq(3).addClass("scrool")
            $("#window div").eq(3).siblings().removeClass("scrool")
        }
    })
})