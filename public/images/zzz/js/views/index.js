$("#Carousel").carousel({
    inteval:2500
})
$("#myCarouse").carousel({
    inteval:3000
})
$('#myCarousel').carousel({
    interval: 3500
})
$(function () {
    $(".item img").css({width:document.documentElement.clientWidth,height:document.documentElement.clientHeight})
    $("#myCarousel").css({width:document.documentElement.clientWidth,height:document.documentElement.clientHeight})
    $("#left").click(function(){  $("#myCarouse").carousel('prev'); });
    $("#right").click(function(){  $("#myCarouse").carousel('next'); });
    var $new  =   $("#new  .item a>em")
    for(var i =0;i<$new.length;i++){
        $new[i].innerHTML=$new[i].innerHTML.substring(0,50)+"....."
    }
    $(".newFourth p")[0].innerHTML=$(".newFourth p")[0].innerHTML.substring(0,78)+"..."
    var $headTitle = $("#myCarousel .carousel-caption")
    var html=""
    for (var i = 0;i<$headTitle.length;i++){
        var text = $headTitle[i].innerHTML.substring(5,$headTitle[i].innerHTML.lastIndexOf("/")-1)
        for(var j=0;j<text.length;j++){
            html+="<span>"+text[j]+"</span>"
        }
        $headTitle[i].innerHTML="<h2>"+html+"</h2>"
        html=""
    }
    $('#myCarousel').on('slid.bs.carousel', function () {
       var eml = $(this).find(".active .carousel-caption h2 span")
       var times=setTimeout(function () {
           clearTimeout(times)
           var j = eml.length;
           times=setTimeout(function  fn() {
                if(j>-1){
                        eml.eq(j).addClass("animation")
                        j--
                        times=setTimeout(fn,16)
                }else {
                    clearTimeout(times)
                }
           },16)
       })
    })
    $('#myCarousel').on('slide.bs.carousel', function () {
        var eml = $(this).find(".active .carousel-caption h2 span")
        var times=setTimeout(function () {
            clearTimeout(times)
            var j = eml.length;
            times=setTimeout(function  fn() {
                if(j>-1){
                    eml.eq(j).removeClass("animation")
                    j--
                    times=setTimeout(fn,16)
                }else {
                    clearTimeout(times)
                }
            },16)
        })
    })
})
var agent = navigator.userAgent;
if (/.*Firefox.*/.test(agent)) {
    document.addEventListener("DOMMouseScroll", function(e) {
        e = e || window.event;
        var detail = e.detail;
        if (detail > 0) {
            $("#myCarousel").carousel('prev');
        } else {
            $("#myCarousel").carousel('next');
        }
    });
} else {
    document.onmousewheel = function(e) {
        e = e || window.event;
        var wheelDelta = e.wheelDelta;
        if (wheelDelta > 0) {
            $("#myCarousel").carousel('prev');
        } else {
            $("#myCarousel").carousel('next');
        }
    }
}
window.onresize=function (ev) {
    $(".item img").css({width:document.documentElement.clientWidth,height:document.documentElement.clientHeight})
    $("#myCarousel").css({width:document.documentElement.clientWidth,height:document.documentElement.clientHeight})
}