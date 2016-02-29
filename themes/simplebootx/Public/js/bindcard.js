$(function(){
	moli.init();
});
var moli = {
        init : function(){
        	moli.bind();
        },
        bind : function(){
            var self = this;
            $(".surea").click(function(){
            	self.Field();
            	self.next();
            }); 
        },
        Field : function(){    
            
            this.cardnum = $.trim($($('input')[1]).val()).replace(/\s+/g, "");
            this.cardbank = $.trim($('.blan').find('option:checked').html()).replace(/\s+/g, "");
            this.cardzh = $.trim($($('input')[2]).val()).replace(/\s+/g, "");
        }, 
        value_check : function(){
           
            if(this.cardnum == ''){
            	$(".cardnum").html('卡号不能为空');
            	return false;
            }   
            $(".cardnum").hide();
            if(this.cardbank == ''){
            	$(".bank").html('银行不能为空');
            	return false;
            }   
            $(".bank").hide();
            if(this.cardzh == ''){
            	$(".cardzh").html('开户支行不能为空');
            	return false;
            }    
            $(".cardzh").hide();
            return true;
        },
        next : function(){
            if(moli.value_check()){
            	submit();
            }
        } 
        }
        function submit(){
            $('#cardform').submit();
        }         