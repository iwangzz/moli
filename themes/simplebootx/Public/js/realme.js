$(function () {
    real.init();
});
var real = {
    init: function () {
        real.bind();
    },
    bind: function () {
        var self = this;
        $("#realsubmit").click(btns = function () {
            self.Field();
            self.next();
        });
    },
    Field: function () {
        this.name = $.trim($($('input')[0]).val()).replace(/\s+/g, "");
        this.numbers = $.trim($($('input')[1]).val()).replace(/\s+/g, "");
    },
    value_check: function () {
        if (this.name == '') {
            $('.fly1').show().find('span').html('输入不为空!');
            return false;
        } else if (!this.name.match(/^[\u4e00-\u9fa5]{2,8}$/g)) {
            $('.fly1').show().find('span').html('输入有误!');
            return false;
        }
        $('.fly1').hide();
        if (this.numbers == '') {
            $('.fly2').show().find('span').html('身份证不为空!');
            return false;
        } else if (!/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/.test(this.numbers)) {
            $('.fly2').show().find('span').html('输入有误!');
            return false;
        }
        $('.fly2').hide();
        return true;
    },
    next: function () {
        if (real.value_check()) {
            submit();
        }
    }
}
function submit() {
    $("#realform").submit();
}
// function onlyWriteNum(e,obj){
// 	var currKey=0,e=e || event;
// 	currKey=e.keyCode||e.which||e.charCode;
// 	var keyName = String.fromCharCode(currKey);
// 	if(currKey == 37 || currKey == 39 || currKey == 8 || currKey == 46){
// 		return;
// 	}
// 	if(obj.value.length==1){
// 		obj.value=obj.value.replace(/[^1-9]/g,'');
// 	}
// 	else{
// 		obj.value=obj.value.replace(/\D/g,'');
// 	}
// }
// function vaildIntegerNumber(evnt){
// 	evnt=evnt||window.event;
// 	var keyCode=window.event?evnt.keyCode:evnt.which;
// 	return keyCode>=48&&keyCode<=57||keyCode==8;
// }  