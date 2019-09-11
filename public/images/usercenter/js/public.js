$(function () {
    var img=0;
    var firsttip = $("#tip-fater li").first().clone()
    $("#tip-fater").append(firsttip).width($("#tip-fater li").length*($("#tip-fater li").width()));
    timer=setInterval(function(){

        img++;

        if (img==$('#tip-fater li').length) {

            img=1;

            $('#tip-fater').css({left:0});

        };

        $('#tip-fater').stop().animate({left:-(img*280)+"px"},1000);
    },3000)
    //鼠标移入暂停播放
    $("#tip").hover(function () {
        clearInterval(timer)
    },function () {
        timer=setInterval(function(){

            img++;

            if (img==$('#tip-fater li').length) {

                img=1;

                $('#tip-fater').css({left:0});

            };

            $('#tip-fater').stop().animate({left:-(img*280)+"px"},1000);
        },3000)
    })
})