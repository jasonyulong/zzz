$(function () {
    $(window).on("scroll",function () {
            setInterval(function () {
                if($(window).scrollTop() > 1300){
                    $("#second_Head").slideDown(500)
                    $("#indexNav").hide()
                }else{
                    $("#second_Head").hide()
                    $("#indexNav").show()
                }
            },50)


    })
    $(".fdialog-close").click(function () {
        $(".fdialog-main").hide();
    })
    $("#ico1").click(function () {
        $(".fdialog-main").show();
    })
    $(".fdialog-main").mouseup(function () {
        return false
    })
    $(document).mouseup(function()
    {
        $(".fdialog-main").hide()
    });



})
window.onload=function () {
    $("#news_head").addClass("a-bouncein")
    var addanimation1=function () {

        var $headTitle = $("#animation_h2")
        var html = ""
        for(var i = 0;i<$headTitle[0].innerText.length;i++){
            html+="<span>"+$headTitle[0].innerText[i]+"</span>";
        }
        $headTitle.html(html)
        var k=  $("#animation_h2 span").length;
        var times=setTimeout(function  fn() {
            if(k>-1){
                $("#animation_h2 span").eq(k).addClass("animation")
                k--
                times=setTimeout(fn,16)
            }else {
                clearTimeout(times)
            }
        },16)
    }()
    var addanimation=function () {
        var $headTitle = $("#animation_p")
        var html = ""
        var len= $headTitle[0].innerText.length;
        for(var i = 0;i<len;i++){
            html+="<span>"+$headTitle[0].innerText[i]+"</span>";
        }
        $headTitle.html(html)
        var j =  $("#animation_p span").length;
        var  times1=setTimeout(function  fn() {
            if(j>-1){
                $("#animation_p span").eq(j).addClass("animation")
                j--
                times=setTimeout(fn,16)
            }else {
                clearTimeout(times1)
            }
        },16)
    }()
}



