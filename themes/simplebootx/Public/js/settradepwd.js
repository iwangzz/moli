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
        }else if(!/^[A-Za-z0-9]+$/.test(this.payPassword_1) || this.payPassword_1.length < 6){
            $('.fly1').show().find('span').html('密码为6-16位字符!');
            return false;
        }
        $('.fly1').hide();
        if(this.payPassword_2 == ''){
            $('.fly2').show().find('span').html('确认密码不为空!');
            return false;
        }else if(!/^[A-Za-z0-9]+$/.test(this.payPassword_2)){
            $('.fly2').show().find('span').html('密码为6-16位字符!');
    		return false;
        }else if(this.payPassword_1 != this.payPassword_2){
            $('.fly2').show().find('span').html('两次密码不一致!');
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
    var tradedata = $('#settradeform').serialize();
    $.ajax({
        url: '/index.php/user/index/checktradepwdCode',
        type: 'POST',
        data: tradedata,
        success: function (data) {
            if (data.status == 0) {
                alert(data.msg);
            } else if (data.status == 1) {
                alert(data.msg);
                window.location.href = '/index.php/user/index/accountinfo'
            }
        }
    });
}
function timeDown(id, n) {
    function jishi() {
        n--;
        n = n <= 0 ? 0 : n;
        if (n == 0) {
            $('#sendCode').css('color', '#0084e8');
            $('#' + id).empty();
            $('#' + id).html('<b></b><span>请重新获取</span>');
            $('#times').find('span').css('color','#0084e8');
            $('.fly3').find('span').css('color','#ffffff');
        } else {
            $("#sendCode").html('秒后重新获取');
           $('#' + id).find('span').html('秒后重新获取');
            $('#' + id).show().find('b').html(n);
            $('#sendCode').css('color', '#CCCCCC');
        }
    }

    var t = setInterval(function () {
        if (n <= 0) {
            clearTimeout(t);
        } else {
            jishi();
        }
    }, 1000);
}