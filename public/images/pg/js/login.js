$(function () {
    $("#loginform").submit(function () {
        var username=$("#username").val()
        var password=$("#password").val()
        if(username==""){
            $("#msg").html("用户名不能为空")
            return false
        }
        if(password==""){
            $("#msg").html("密码不能为空")
            return false
        }
        return true
    })
})