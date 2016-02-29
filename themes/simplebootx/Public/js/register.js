$(function(){
    register.init();
});
var register ={
    init : function(){
        register.bind();
    },
    flag : false,
    bind : function(){
        var self = this;
        $(".registered-now").click(function(){
            self.Field();
            self.next();
        });
    },
    Field : function(){
        this.user = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        this.passwad = $.trim($($('input')[1]).val()).replace(/\s+/g, "");
        this.usercode = $.trim($($('input')[2]).val()).replace(/\s+/g, "");
        this.code = $.trim($($('input')[3]).val()).replace(/\s+/g, "");
    },
    value_check : function(){
        if(this.user == ''){
            $(".error-message").show().find('span').html('请输入您的手机号！');
            $(".inp-a").css('border','1px solid #ee7565');
            $(".inp-a").focus(function(){
                    $(".inp-a").css ({"border":"1px solid #ee7565","box-shadow":"0 0 8px rgba(255,0,0,.6)"})}
            );
            return false;
        }else if(!/^1[34578]\d{9}$/.test(this.user)){
            $(".error-message").show().find('span').html('您的输入有误！');
            $(".inp-a").css('border','1px solid #ee7565');
            return false;
        }
        $(".inp-a").css('border','1px solid #a09c98');
        $('.error-message').hide();
        if(this.passwad == ''){
            $(".error-pwd").show().find('span').html('请输入您的密码！');
            $(".inp-b").css('border','1px solid #ee7565');
            return false;
        }else if(!/^[A-Za-z0-9]+$/.test(this.passwad) || this.passwad.length < 8){
            $(".error-pwd").show().find('span').html('请输入8到16位英文或数字！');
            $(".inp-b").css('border','1px solid #ee7565');
            return false;
        }
        $(".inp-b").css('border','1px solid #a09c98');
        $('.error-pwd').hide();
        if (this.usercode == '') {
            $('.confirm-pwd').show().find('span').html('请再次输入密码!');
            $(".inp-c").css('border','1px solid #ee7565');
            return false;
        }else if(this.usercode != this.passwad){
            $('.confirm-pwd').show().find('span').html('您第二次输入有误!');
            $(".inp-c").css('border','1px solid #ee7565');
            return false;
        }
        $(".inp-c").css('border','1px solid #a09c98');
        $('.confirm-pwd').hide();
        if(!register.flag){
            $(".time-code").show().find('span').html('请先获取验证码！');
            $(".inp-d").css('border','1px solid #ee7565');
            return false;
        }
        if(this.code == ''){
            $(".time-code").show().find('span').html('请输入验证码！');
            $(".inp-d").css('border','1px solid #ee7565');
            return false;
        }else if(!/^\d{6}$/.test(this.code)){
            $(".time-code").show().find('span').html('您输入的验证码有误！');
            $(".inp-d").css('border','1px solid #ee7565');
            return false;
        }
        $(".inp-d").css('border','1px solid #a09c98');
        $('.time-code').hide();
        if(!$('input[type=checkbox]').is(':checked')){
            alert('请同意服务协议！');
            return false;
        }
        return true;
    },
    next: function () {
        if (register.value_check()) {
            submit();
        }
    }

}
function submit(){
    alert('注册成功');
}
function onlyWriteNum(e, obj) {
    var currKey = 0, e = e || event;
    currKey = e.keyCode || e.which || e.charCode;
    var keyName = String.fromCharCode(currKey);
    if (currKey == 37 || currKey == 39 || currKey == 8 || currKey == 46) {
        return;
    }
    if (obj.value.length == 1) {
        obj.value = obj.value.replace(/[^1-9]/g, '');
    }
    else {
        obj.value = obj.value.replace(/\D/g, '');
    }
}
function vaildIntegerNumber(evnt) {
    evnt = evnt || window.event;
    var keyCode = window.event ? evnt.keyCode : evnt.which;
    return keyCode >= 48 && keyCode <= 57 || keyCode == 8;
}
$(function(){
    $('.obtain-code').on('click',btn=function(){
        var p = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        if(p == ''){
            $(".error-message").show().find('span').html('请输入您的手机号！');
            return false;
        }else if(!/^1[34578]\d{9}$/.test(p)){
            $(".error-message").show().find('span').html('您的输入有误！');
            return false;
        }
        var regphone = $('#registerform').serialize();
        console.log(regphone);
        $.ajax({
            url: '/index.php/user/register/sendregCode',
            type: 'POST',
            data: regphone,
            success: function (msg) {
                if (msg.status == 0) {
                    alert(msg.msg);
                } else if (msg.status == 1) {
                    $('.time-code').hide();
                    $('.error-message').hide();
                    $('.obtain-code').off();
                    $('.divbg').css('background','#CCCCCC');
                    $('.second').find('span').css('color','gray');
                    setTimeout(function(){$('.obtain-code').hide();},1000);
                    timeDown('times',90);
                    register.flag = true;
                }
            }
        });
    })
});
function timeDown(id,n){
    function jishi(){
        n--;
        n = n <=0 ? 0 : n;
        if(n == 0){
            $('.divbg').css('color','#ffffff');
            $('.divbg').on('click',btn);
            $('#' + id).empty();
            $('#' + id).html('<b></b><span>请重新获取</span>');
            $('.divbg').css('background','#3a84cf');
            $('.divbg').on('click',btn);
        }else{
            $('#' + id).find('span').html('秒后重新获取');
            $('#' + id).show().find('b').html(n);
        }
    }
    var t = setInterval(function(){
        if (n<=0){
            clearTimeout(t);
        }else{
            jishi();
        }
    }, 1000);
}