$(function () {
    $("#register").submit(function () {
        var username=$("#username").val()
        var password=$("#password").val()
        var repassword=$("#repassword").val()
        var phone=$("#phone").val()
        var email=$("#email").val()
        var reg=/^[a-z0-9_-]{6,16}$/
        var reg1=/^1(3|4|5|7|8)\d{9}$/
        var reg3=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
        console.log(reg)
        if(!reg.test(username)){
            $("#msg").html("请输入正确的用户名，为6-16为的数组和字母组成")
            return false
        }
        if(!reg.test(password)){
            $("#msg").html("请输入正确的密码，为6-16为的数组和字母组成")
            return false
        }
        if(!reg.test(password)){
            $("#msg").html("请输入正确的密码，为6-16为的数组和字母组成")
            return false
        }
        if(!reg.test(repassword)){
            $("#msg").html("请输入正确的密码，为6-16为的数组和字母组成")
            return false
        }
        if(password != repassword){
            $("#msg").html("两次密码不一样")
            return false
        }
        if(!reg1.test(phone)){
            $("#msg").html("请输入正确的电话号码")
            return false
        }
        if(!reg3.test(email)){
            $("#msg").html("请输入正确的电子邮箱")
            return false
        }
        if(!($('#radio').is(':checked'))){
            $("#msg").html("请阅读用户协议")
            return false
        }
        return true
    })
})