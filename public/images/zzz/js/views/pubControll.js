$.ajax({
    url :"foot.html",
    type:"get",
    dataType:"html",
    success:function (data) {
        $("body").append(data)
    }
})
$.ajax({
    url:"head.html",
    type:"get",
    dataType:"html",
    success:function (data) {
        $("body").prepend(data)
    }
})