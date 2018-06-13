$(function() {
    autoLeftNav();
    //滚动字幕
    textTime = displayAnnouncement();
    clearInterval(textTime);
    textTime = setInterval("displayAnnouncement()", 600000);
    
    $(window).resize(function() {
        autoLeftNav();
    });
})
//展示公告内容
function displayAnnouncement() {
    var announcement = '';
    //回传后台
    $.ajax({
        url: '/admin/announcement/getAnnouncement',
        type: "POST",
        dataType:"JSON",
        data: {},
        success: function(return_data){
            $.each(return_data.data, function(index, object) {
                announcement += object.content;
            });
            scrollText($('#scroll_text'),30,600,announcement,"left",1,30);
        }
    });
    
}

// 风格切换

$('.tpl-skiner-toggle').on('click', function() {
    $('.tpl-skiner').toggleClass('active');
})

$('.tpl-skiner-content-bar').find('span').on('click', function() {
    $('body').attr('class', $(this).data('color'))
    saveSelectColor.Color = $(this).data('color');
    // 保存选择项
    storageSave(saveSelectColor);

})

// 侧边菜单开关
function autoLeftNav() {

    $('.tpl-header-switch-button').on('click', function() {
        if ($('.left-sidebar').is('.active')) {
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').removeClass('active');
            }
            $('.left-sidebar').removeClass('active');
        } else {

            $('.left-sidebar').addClass('active');
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').addClass('active');
            }
        }
    })

    if ($(window).width() < 1024) {
        $('.left-sidebar').addClass('active');
    } else {
        $('.left-sidebar').removeClass('active');
    }
}


// 侧边菜单
$('.sidebar-nav-sub-title').on('click', function() {
    $(this).siblings('.sidebar-nav-sub').slideToggle(80)
        .end()
        .find('.sidebar-nav-sub-ico').toggleClass('sidebar-nav-sub-ico-rotate');
})

//设置左边 body 的高度
$(".left-sidebar").css({
    "height" : $(document).height() +"px"
});

//初始化菜单的展开状态
$("#sidebar-nav .sidebar-nav-link a").each(function (idx, ele) {
    var host = location.protocol+"//"+location.host;
    var href = location.href.replace(host, '');
    if ($(ele).attr("href") == href) {
        $(ele).addClass("sub-active");
        $(ele).closest(".sidebar-nav").prev().trigger("click");
        return;
    }
})

var scrollTime;
/**
* @param appendToObj 显示位置（目标对象）
* @param showHeight  显示高度
* @param showWidth   显示宽度
* @param showText    显示信息
* @param scrollDirection    滚动方向（值：left、right）
* @param teper       每次移动的间距（单位：px；数值越小，滚动越流畅，建议设置为1px）
* @param interval:   每次执行运动的时间间隔（单位：毫秒；数值越小，运动越快）
*/
function scrollText (appendToObj,showHeight,showWidth,showText,scrollDirection,steper,interval) {
    var textWidth, posInit;
    var posSteper = 0;

    clearInterval(scrollTime);
    appendToObj.html('');
    appendToObj.css('height',showHeight+'px').css('line-height',showHeight+'px').css('width',showWidth).css('overflow', 'hidden');
    //调整宽带，左侧距离
    var adjustWidth = parseInt(appendToObj.prop("offsetLeft"));

    if (scrollDirection == 'left'){
        posInit = showWidth;
        posSteper = steper;
    }else{
        posSteper = 0 - steper;
    }
    //每次移动间距超出限制(单位:px)
    if (steper < 1 || steper > showWidth) {
        steper = 1
    }
    //每次移动的时间间隔（单位：毫秒）
    if (interval < 1) {
        interval = 10
    }
    var $container = $('<div></div>');
    var containerID = 'containerTemp';
    var i = 0;
    while ($('#'+containerID).length > 0) {
        containerID = containerID + '_' + i;
        i++;
    }

    $container.attr('id',containerID).css('float','left');
    $container.css('height', showHeight+'px').css('line-height', showHeight+'px').css('display', 'inline-block').css('overflow', 'hidden').css('white-space', 'nowrap');
    $container.appendTo(appendToObj);
    $container.html(showText);
    textWidth = $container.width();
    if (isNaN(posInit)) {
        posInit = 0 - textWidth;
    }
    $container.css('margin-left',posInit);
    $container.mouseover(function() {
        clearInterval(scrollTime);
    });
    $container.mouseout(function() {
        scrollTime = setInterval("scrollAutoPlay('"+containerID+"','"+scrollDirection+"',"+showWidth+','+textWidth+","+posSteper+','+adjustWidth+")", interval);
    });

    scrollTime = setInterval("scrollAutoPlay('"+containerID+"','"+scrollDirection+"',"+showWidth+','+textWidth+","+posSteper+','+adjustWidth+")", interval);
}
/**
* @param contID  显示容器
* @param scrollDirection    滚动方向（值：left、right）
* @param showWidth   显示宽度
* @param textWidth   文本宽度
* @param steper       每次移动的间距（单位：px；数值越小，滚动越流畅，建议设置为1px）
* @param adjustWidth  调整的宽带
*/
function scrollAutoPlay(contID, scrolldir, showWidth, textWidth, steper, adjustWidth){
    var posInit,currPos;
    var $contID = $('#'+contID);
    currPos = parseInt($contID.css('margin-left'));
    if (scrolldir == 'left') {
        if (currPos < 0 && Math.abs(currPos) > textWidth - adjustWidth) {
            $contID.css('margin-left', showWidth);
        }else{
            $contID.css('margin-left', currPos - steper);
        }
    }else{
        if(currPos > showWidth - adjustWidth){
            $contID.css('margin-left', ( 0 - textwidth));
        }else{
            $contID.css('margin-left', currPos - steper);
        }
    }
}
        