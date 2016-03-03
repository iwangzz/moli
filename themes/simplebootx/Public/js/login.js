$(function(){
	$('input:text:first').focus();
	var $inp = $('input');
	$inp.keypress(function (e) {
		var key = e.which;
		if (key == 13) {
			$("#login").click();
		}
	});
	login.init();
});
var login = {
	init : function(){
		login.bind();
	},
	bind : function(){
		var self = this;
		$("#login").click(function(){
			self.Field();
			self.next();
		});
		$('.lopu1').blur(function(){
			if(/^1[34578]\d{9}$/.test($.trim($($('input')[0]).val()).replace(/\s+/g, ""))){
				$(".none").hide();
				$(".lopu1").css('border','');
			}
		});
	},
	Field : function(){
		this.loginphone = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
		this.loginnum = $.trim($($('input')[1]).val()).replace(/\s+/g, "");
	},
	value_check : function(){
		if(this.loginphone == ''){
			$(".none").show().html('不能为空');
			$(".lopu1").css('border','1px solid #ee7565');
			//$(".lopu1").focus(function(){
			//		$(".lopu1").css ({"outline":"none","border-color":"rgba(82, 168, 236, .8)","box-shadow":"0 0 8px rgba(82, 168, 236, .6)"})}
			//);
			return false;
		}else if(!/^1[34578]\d{9}$/.test(this.loginphone)){
			$(".none").show().html('您输入的号码有误');
			$(".lopu1").css('border','1px solid #ee7565');
			return false;
		}
		$(".none").hide();
		$(".lopu1").css('border','1px solid #a09c98');
		if(this.loginnum == ''){
			$(".none").show().html('不能为空');
			$(".low").css('border','1px solid #ee7565');
			return false;
		}
		$(".none").hide();
		$(".low").css('border','1px solid #a09c98');
		return true;
	},
	next: function () {
		if (login.value_check()) {
			submit();
		}
	}
};
function submit(){
    //alert('登陆成功')
    var logindata = $('#loginform').serialize();
    $.ajax({
        url: '/index.php/user/login/dologin',
        type: 'POST',
        data: logindata,
        success: function (data) {
            if (data.status == 0) {
				$(".none").show().html('用户名与密码不匹配，请重新输入。');
            } else if (data.status == 1) {
                //alert(data.msg)
                $("#loginform").submit();
                window.location.href = '/'
            }
        }
    })
}
function onlyWriteNum(e,obj){
	var currKey=0,e=e || event;
	currKey=e.keyCode||e.which||e.charCode;
	var keyName = String.fromCharCode(currKey);
	if(currKey == 37 || currKey == 39 || currKey == 8 || currKey == 46){
		return;
	}
	if(obj.value.length==1){
		obj.value=obj.value.replace(/[^1-9]/g,'');
	}
	else{
		obj.value=obj.value.replace(/\D/g,'');
	}
}
function vaildIntegerNumber(evnt){
	evnt=evnt||window.event;
	var keyCode=window.event?evnt.keyCode:evnt.which;
	return keyCode>=48&&keyCode<=57||keyCode==8;
}