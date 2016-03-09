$(function(){
	modifyLogin.init();
});
var modifyLogin = {
	init : function(){
		modifyLogin.bind();
	},
	bind : function(){
	    var self = this;
	    $("#clsubmit").click(function(){
    		self.Field();
    		self.next();
    	});	
	},
	Field : function(){
        this.oldPassword = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        this.newPassward_1= $.trim($($('input')[1]).val()).replace(/\s+/g, "");
        this.newPassward_2= $.trim($($('input')[2]).val()).replace(/\s+/g, "");
	},
	value_check : function(){
        if(this.oldPassword == ''){
            $('.fly1').show().find('span').html('原始密码不为空!');
            return false;
        }else if(!/^[A-Za-z0-9]+$/.test(this.oldPassword) || this.oldPassword.length < 6){
            $('.fly1').show().find('span').html('请输入6-16位字符!');
            return false;
        }
        $('.fly1').hide();
        if(this.newPassward_1 == ''){
            $('.fly2').show().find('span').html('新密码不为空!');
            return false;
        }else if(!/^[A-Za-z0-9]+$/.test(this.newPassward_1) || this.newPassward_1.length < 6){
            $('.fly2').show().find('span').html('请输入6-16位字符!');
    		return false;
        }
        $('.fly2').hide();
        if(this.newPassward_2 == ''){
            $('.fly3').show().find('span').html('确认密码不为空!');
            return false;
        }else if(!/^[A-Za-z0-9]+$/.test(this.newPassward_2) || this.newPassward_2.length < 6){
            $('.fly3').show().find('span').html('您输入有误!');
    		return false;
        }else if(this.newPassward_1 != this.newPassward_2){
            $('.fly3').show().find('span').html('两次密码输入不一致!');
    		return false;
        }
        $('.fly3').hide();
        return true;
	},
	next : function(){
	     if(modifyLogin.value_check()){
	         submit();
	     }
	}
}
function submit(){
    var loginpassdata = $('#changeloginpwdform').serialize();
    //console.log(loginpassdata);
    $.ajax({
        url: '/index.php/user/index/do_changeloginpwd',
        type: 'POST',
        data: loginpassdata,
        success: function (data) {
            if (data.status == 0) {
                alert(data.msg);
            } else if (data.status == 1) {
//                        alert(data.msg);
                window.location.href = '/index.php/user/login'
            }
        }
    })
}
