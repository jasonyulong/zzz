$(function () {
    $.ajax({
        url :"aboutUS_pub.html",
        type:"get",
        dataType:"html",
        success:function (data) {
            $("#indexNav").after(data)
        }
    })
})
