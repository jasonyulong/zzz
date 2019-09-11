$(function () {
    $('#chooseImage').on('change',function(){
        var filePath = $(this).val()     //获取到input的value，里面是文件的路径
        console.log(filePath)
        var fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase();
        console.log(fileFormat)
        var src = window.URL.createObjectURL(this.files[0]);
        var size=window.URL.createObjectURL(this.files[0]).size
        // 检查是否是图片
        $('#changeimg img').attr('src',src);
        if( !fileFormat.match(/.png|.jpg|.jpeg/) ) {
            $("#msg").html("图片格式不正确")
            return false;
        }else if(size>2*1024*1024){
            $("#msg").html("图片不能超过2M")
            return false;
        }else{
            $("#msg").html("")
        }
    });
    $("form").submit(function () {
        var filePath = $('#chooseImage').val()     //获取到input的value，里面是文件的路径
        if(filePath == ""){
            $("#msg").html("您还没有选择头像")
            return false
        }
        console.log(filePath)
        var fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase();
        console.log(fileFormat)
        console.log(fileFormat.match(/.png|.jpg|.jpeg/))
        // 检查是否是图片
        if( !fileFormat.match(/.png|.jpg|.jpeg/) ) {
            $("#msg").html("图片格式不正确")
            return false;
        }else if(size>2*1024*1024){
            $("#msg").html("图片不能超过2M")
            return false;
        }else{
            $("#msg").html("")
        }
        return true;
    })

})