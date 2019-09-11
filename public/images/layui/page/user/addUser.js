var $;
layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage;
		$ = layui.jquery;

 	var addUserArray = [],addUser;
 	form.on("submit(addUser)",function(data){
 		//是否添加过信息
	 	if(window.sessionStorage.getItem("addUser")){
	 		addUserArray = JSON.parse(window.sessionStorage.getItem("addUser"));
	 	}

	 	var userStatus,userGrade,userEndTime;
	 	//会员等级
	 	if(data.field.userGrade == '0'){
 			userGrade = "注册会员";
 		}else if(data.field.userGrade == '1'){
 			userGrade = "中级会员";
 		}else if(data.field.userGrade == '2'){
 			userGrade = "高级会员";
 		}else if(data.field.userGrade == '3'){
 			userGrade = "超级会员";
 		}
 		//会员状态
 		if(data.field.userStatus == '0'){
 			userStatus = "正常使用";
 		}else if(data.field.userStatus == '1'){
 			userStatus = "限制用户";
 		}


 	})
	
})

//格式化时间
function formatTime(_time){
    var year = _time.getFullYear();
    var month = _time.getMonth()+1<10 ? "0"+(_time.getMonth()+1) : _time.getMonth()+1;
    var day = _time.getDate()<10 ? "0"+_time.getDate() : _time.getDate();
    var hour = _time.getHours()<10 ? "0"+_time.getHours() : _time.getHours();
    var minute = _time.getMinutes()<10 ? "0"+_time.getMinutes() : _time.getMinutes();
    return year+"-"+month+"-"+day+" "+hour+":"+minute;
}
