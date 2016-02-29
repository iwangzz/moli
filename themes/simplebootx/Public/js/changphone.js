$(function () {
    moks.init();
});
var moks = {
    init: function () {
        moks.bind();
    },
    bind: function () {
        var self = this;
        $(".child8").click(function () {
            self.Field();
            self.next();
        });
    },
    Field: function () {
        this.phone = $.trim($("#phone").val()).replace(/\s+/g, "") == '' ? '' : $.trim($("#phone").val()).replace(/\s+/g, "");
    },
    value_check: function () {
        if (this.phone == '') {
            $('.prompt').show().find('span').html('手机号码不为空!');
            return false;
        } else if (!/^1[34578]\d{9}$/.test(this.phone)) {
            $('.prompt').show().find('span').html('手机号码格式不正确!');
            return false;
        }
        return true;
    },
    next: function () {
        if (moks.value_check()) {
            submit();
        }
    }
}
function submit() {
    //alert('成功');
    var finddata = $('#findpwdform').serialize();
    $.ajax({
        url: '/index.php/user/public/checkpwdCode',
        type: 'POST',
        data: finddata,
        success: function (data) {
            if (data.status == 0) {
                alert(data.msg);
            } else if (data.status == 1) {
                alert(data.msg);
                var mobile = data.phone;
                var flag = data.flag;
                window.location.href = '/index.php/user/public/setnewpassDisplay?mobile='+mobile+'&flag='+flag;
            }
        }
    });
}
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