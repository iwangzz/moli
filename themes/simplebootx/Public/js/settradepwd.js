$(function(){
	setPay.init();
});
var setPay = {
	init : function(){
		setPay.bind();
	},
	bind : function(){
	    var self = this;
	    $(".subs").click(function(){
    		self.Field();
    		self.next();
    	});
	},
	Field : function(){
        this.payPassword_1 = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        this.payPassword_2= $.trim($($('input')[1]).val()).replace(/\s+/g, "");
        this.code= $.trim($($('input')[2]).val()).replace(/\s+/g, "");
	},
	value_check : function(){
        if(this.payPassword_1 == ''){
            $('.fly1').show().find('span').html('密码不能为空!');
            return false;
        }else if(!/^\d{6}$/.test(this.payPassword_1)){
            $('.fly1').show().find('span').html('密码为6位数字!');
            return false;
        }
        $('.fly1').hide();
        if(this.payPassword_2 == ''){
            $('.fly2').show().find('span').html('确认密码不为空!');
            return false;
        }else if(!/^\d{6}$/.test(this.payPassword_2)){
            $('.fly2').show().find('span').html('密码为6位数字!');
    		return false;
        }else if(this.payPassword_1 != this.payPassword_2){
            $('.fly2').show().find('span').html('密码不一致!');;
    		return false;
        }
        $('.fly2').hide();
        if(this.code == ''){
            $('.fly3').show().find('span').html('验证码不能为空!');
            return false;
        }else if(!/^\d{6}$/.test(this.code)){
            $('.fly3').show().find('span').html('输入有误!');
            return false;
        }
        $('.fly3').hide();
        return true;
	},
	next : function(){
	     if(setPay.value_check()){
	         submit();
	     }
	}
}
function submit(){
    //alert('设置成功');
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