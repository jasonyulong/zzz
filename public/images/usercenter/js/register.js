$(function () {
    //用户名验证

    $('#reg-user').blur(function(){
        var username = $(this).val().replace(/\s+/g,'');
        if(username == ''){
            $(".msg:eq(0)").html("请填写用户名")
            return false;
        }
        var uPattern = /^[a-zA-Z0-9_-]{6,11}$/;
        if(!uPattern.test(username)){
            $(".msg:eq(0)").html("用户名为6-16位的数字，字母组成")
            return false;
        }else{
            $(".msg:eq(0)").html("√").addClass("success")
        }
        return true
    })
    //邮箱验证
    $("#email").blur(function () {
        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //正则表达式
        var email=$(this).val().replace(/\s+/g,'');
        if(email === ""){ //输入不能为空
            $(".msg:eq(1)").html("请填写邮箱")
            return false;
        }else if(!reg.test(email)){ //正则验证不通过，格式不对
            $(".msg:eq(1)").html("请填写正确的邮箱地址")
            return false;
        }else{
            $(".msg:eq(1)").html("√").addClass("success")
        }
    })
    // 密码验证
    $('#password').blur(function(){
        var password = $(this).val().replace(/\s+/g,'');
        var pPattern = /^[a-zA-Z0-9_-]{6,16}$/;
        if(password == ''){
            $(".msg:eq(2)").html("密码不能为空")
            return false;
        }
        if(!pPattern.test(password)){
            $(".msg:eq(2)").html("密码名为6-16位的数字，字母组成")
            return false;
        }else{
            $(".msg:eq(2)").html("√").addClass("success")
        }
    })
    //确认密码
    $("#repassword").blur(function () {
        var repassword = $(this).val().replace(/\s+/g, '');
        var password = $("#password").val().replace(/\s+/g,'');
        if(repassword ==     ""){
            $(".msg:eq(3)").html("确认密码不能为空！")
            return false
        }else if(repassword != password){
            $(".msg:eq(3)").html("两次密码不一致！")
            return false
        }else{
            $(".msg:eq(3)").html("√").addClass("success")
        }
    })

    $("#register").submit(function () {
           var flang=true
            $(".msg").each(function () {
                if(!$(this).hasClass("success")){
                      $("#reg-msg").html("请按要求填写表单，完成注册!")
                       flang = false
                }
            })
            return flang
    })

})