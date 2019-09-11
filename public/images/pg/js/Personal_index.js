$(function () {
    $("#window div").click(function () {
        var $index = $(this).index()
        console.log($index)
        if($index==0){
            location.href="/user/index/askadd.html"
        }
        if($index==1){
            location.href="/user/index/ask.html"
        }
        if($index==2){
            location.href="/user/cang/article.html"
        }
        if($index==3){
            location.href="/user/user/face.html"
        }
        if($index==4){
            location.href="/user/user/repass.html"
        }
    })
})