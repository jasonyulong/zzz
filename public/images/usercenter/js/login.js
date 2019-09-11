$(function () {
    $("#loginfrom").submit(function () {
        var username=$.trim($("#username").val()).substr(0,16)
        var password = $.trim($('#password').val()).substr(0,16);
        var vcode = $.trim($('#true').val()).substr(0,4)
        if(username == ""){
            $("#usermsg").html("请输入用户名")
            return false
        }
        if(password == ""){
            $("#pwdmsg").html("请输入密码")
        }
        if(vcode=""){
            $("#regsitmsg").html("请输入验证码")
        }
    })
})