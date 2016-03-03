$(function () {
    moks.init();
});
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

//
var moks = {
    init: function () {
        moks.bind();
    },
    bind: function () {
        var self = this;
        $(".yers3").click(function () {
            self.Field();
            self.next();
        });
    },
    Field: function () {
        this.phone = $.trim($(".mok3").val()).replace(/\s+/g, "") == '' ? '' : $.trim($(".mok3").val()).replace(/\s+/g, "");
    },
    value_check: function () {
        if (this.phone == '') {
            $('.prompt').show().find('span').html('手机号码不为空!');
            return false;
        } else if (!/^1[34578]\d{9}$/.test(this.phone)) {
            $('.prompt').show().find('span').html('您的输入有误!');
            return false;
        }
        return true;
    },
    next: function () {
        if (moks.value_check()) {
            submit();
        }
    }
};
function submit() {
    var newphonecodedata = $('#newphoneform').serialize();
    console.log(newphonecodedata);
    $.ajax({
        url: '/index.php/user/index/checknewphonecode',
        type: 'POST',
        data: newphonecodedata,
        success: function (data) {
            if (data.status == 0) {
                alert(data.msg);
            } else if (data.status == 1) {
                var flag = data.flag;
                window.location.href = '/index.php/user/index/phonesuccess?flag='+flag
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
			
			