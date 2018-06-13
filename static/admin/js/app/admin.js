/**
 * 管理员模块js
 * @author yangjian
 */
"use strict";
define(function(require, exports) {

    var common = require("common");
    require("chosen");

    common.initForm("#cAdd");
    //初始化 switch 控件
    common.initSwitch();
    
    //初始化角色选择
	$('#chosen-select').chosen({
		max_selected_options: 5
	});
	require("datepicker");
	// 时间选择控件
	$(".datetime").datetimepicker({
		format: 'yyyy-mm-dd hh:ii:00',
		minuteStep: 30,
		minView : 0,
		autoclose : true
	});

});
