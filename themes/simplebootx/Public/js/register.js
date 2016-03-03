$(function () {
    $('input:text:first').focus();
    var $inp = $('input');
    $inp.keypress(function (e) {
        var key = e.which;
        if (key == 13) {
            $(".registered-now").click();
        }
    });
    register.init();
});
var register = {
    init: function () {
        register.bind();
    },
    flag: false,
    bind: function () {
        var self = this;
        $(".registered-now").click(function () {
            self.Field();
            self.next();
        });
        $("input[name='mobile']").blur(function () {
            if ($.trim($(this).val()).replace(/\s+/g, "") != '') {
                register.check_val('phone', $.trim($(this).val()).replace(/\s+/g, ""));
            }
        });
        $("input[name='password']").blur(function () {
            if ($.trim($(this).val()).replace(/\s+/g, "") != '') {
                register.check_val('pw1', $.trim($(this).val()).replace(/\s+/g, ""));
            }
        });
        $("input[name='reppassword']").blur(function () {
            if ($.trim($(this).val()).replace(/\s+/g, "") != '') {
                register.check_val('pw2', $.trim($(this).val()).replace(/\s+/g, ""));
            }
        });
        $("input[name='regcode']").blur(function () {
            if ($.trim($(this).val()).replace(/\s+/g, "") != '') {
                register.check_val('code', $.trim($(this).val()).replace(/\s+/g, ""));
            }
        });
    },
    Field: function () {
        this.user = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        this.passwad = $.trim($($('input')[1]).val()).replace(/\s+/g, "");
        this.usercode = $.trim($($('input')[2]).val()).replace(/\s+/g, "");
        this.code = $.trim($($('input')[3]).val()).replace(/\s+/g, "");
    },
    value_check: function () {
        this.Field();
        if (!this.check_val('phone', this.user)) return;
        if (!this.check_val('pw1', this.passwad)) return;
        if (!this.check_val('pw2', this.usercode)) return;
        if (!register.flag) {
            $(".time-code").show().find('span').html('请先获取验证码！');
            $(".inp-d").css('border', '1px solid #ee7565');
            return false;
        }
        if (!this.check_val('code', this.code)) return;
        if (!$('input[type=checkbox]').is(':checked')) {
            alert('请同意服务协议！');
            return false;
        }
        return true;
    },
    check_val: function (type, val) {
        if (type == 'phone') {
            if (val == '') {
                $(".error-message").show().find('span').html('请输入您的手机号码！');
                $(".inp-a").css('border', '1px solid #ee7565');
                return false;
            } else if (!/^1[34578]\d{9}$/.test(val)) {
                $(".error-message").show().find('span').html('您的手机号码输入有误！');
                $(".inp-a").css('border', '1px solid #ee7565');
                return false;
            } else {
                $(".inp-a").css('border', '1px solid #a09c98');
                $('.error-message').hide();
            }
        } else if (type == 'pw1') {
            if (val == '') {
                $(".error-pwd").show().find('span').html('请输入您的密码！');
                $(".inp-b").css('border', '1px solid #ee7565');
                return false;
            } else if (val.length < 6) {
                $(".error-pwd").show().find('span').html('密码长度为6-16个字符');
                $(".inp-b").css('border', '1px solid #ee7565');
                return false;
            } else if (/^[0-9]*$/.test(val)) {
                $(".error-pwd").show().find('span').html('密码不能为纯数字');
                $(".inp-b").css('border', '1px solid #ee7565');
                return false;
            } else {
                var valarr = val.split("");
                var n = [];
                for (var i = 0; i < valarr.length; i++) {
                    if (n.indexOf(valarr[i]) == -1)
                        n.push(valarr[i]);
                }
                if (n.length == 1){
                    $(".error-pwd").show().find('span').html('密码不能为同一字符');
                    $(".inp-b").css('border', '1px solid #ee7565');
                    return false;
                }else{
                    $(".inp-b").css('border', '1px solid #a09c98');
                    $('.error-pwd').hide();
                }
            }
        } else if (type == 'pw2') {
            if (val == '') {
                $('.confirm-pwd').show().find('span').html('请再次输入密码!');
                $(".inp-c").css('border', '1px solid #ee7565');
                return false;
            } else if (val != $.trim($($('input')[1]).val()).replace(/\s+/g, "")) {
                $('.confirm-pwd').show().find('span').html('两次密码输入不一致!');
                $(".inp-c").css('border', '1px solid #ee7565');
                return false;
            } else {
                $(".inp-c").css('border', '1px solid #a09c98');
                $('.confirm-pwd').hide();
            }
        } else if (type == 'code') {
            if (val == '') {
                $(".time-code").show().find('span').html('请输入验证码！');
                $(".inp-d").css('border', '1px solid #ee7565');
                return false;
            } else if (!/^\d{6}$/.test(val)) {
                $(".time-code").show().find('span').html('您输入的验证码格式有误！');
                $(".inp-d").css('border', '1px solid #ee7565');
                return false;
            } else {
                $(".inp-d").css('border', '1px solid #a09c98');
                $('.time-code').hide();
            }
        }
    },
    next: function () {
        if (register.value_check()) {
            submit();
        }
    }

};
function submit() {
    var codedata = $('#registerform').serialize();
    $.ajax({
        url: '/index.php/user/register/checkregCode',
        type: 'POST',
        data: codedata,
        success: function (msg) {
            if (msg.status == 0) {
                alert(msg.msg);
            } else if (msg.status == 1) {
                $('#registerform').submit();
            }
        }
    });
}

$(function () {
    $('.obtain-code').on('click', btn = function () {
        var p = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        if (p == '') {
            $(".error-message").show().find('span').html('请输入您的手机号码！');
            $(".inp-a").css('border', '1px solid #ee7565');
            return false;
        } else if (!/^1[34578]\d{9}$/.test(p)) {
            $(".error-message").show().find('span').html('您的手机号码输入有误！');
            $(".inp-a").css('border', '1px solid #ee7565');
            return false;
        }
        var regphone = $('#registerform').serialize();
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
                    $('.divbg').css('background', '#CCCCCC');
                    timeDown('times', 60);
                    register.flag = true;
                }
            }
        });
    })
});
function timeDown(id, n) {
    function jishi() {
        n--;
        n = n <= 0 ? 0 : n;
        if (n == 0) {
            //$('.divbg').css('color','#ffffff');
            $('.obtain-code').on('click', btn);
            $('#' + id).empty();
            $('#' + id).html('请重新获取');
            $('.divbg').css('background', '#3a84cf');
            $('.obtain-code').css('color', '#ffffff');
        } else {
            $('#' + id).html("<b style='color:#ee7565 !important'>" + n + "</b>秒后重新获取");
            $('#' + id).css('color', 'gray');
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
//控制只输入数字
function vaildIntegerNumber(evnt) {
    evnt = evnt || window.event;
    var keyCode = window.event ? evnt.keyCode : evnt.which;
    return keyCode >= 48 && keyCode <= 57 || keyCode == 8;
}
//输入框只可输入数字
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