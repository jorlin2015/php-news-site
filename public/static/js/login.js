var login = {
	checkRegister : function(){
		var pwd1 = $(".login-wrap [name=password]"),
			pwd2 = $(".login-wrap [name=confirmPassword]");
		if(pwd1.val() != pwd2.val()){
			pwd2.get(0).setCustomValidity('两次输入的密码不匹配');
			return false;
		}else{
			return true;
		}
	}
};