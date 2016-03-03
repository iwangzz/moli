$(function () {
    $('#change-32 div.changeDiv').soChange({					//对象指向层，层内包含图片及标题
        thumbObj:'#change-32 .ul-change-a2 span',
        thumbNowClass:'on',									//自定义导航对象当前class为on
        botPrev:'#change-32 div.pre div',						//按钮，上一个
        botNext:'#change-32 div.next div'						//按钮，下一个
    });
    $('#marquee5').kxbdSuperMarquee({
        distance: 20,
        time: 2,
        direction: 'up'
    });
});





