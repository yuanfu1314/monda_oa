/**
 * 办公室模块js
 * @author yuanfu
 */
"use strict";
define(function(require, exports) {

    var common = require("common");
    //require("chosen");

    common.initForm("#cAdd");

    require("datepicker");

    // 时间选择控件
	$(".datetime").datetimepicker({
		format: 'yyyy-mm-dd hh:ii:00',
		minuteStep: 30,
		minView : 0,
		autoclose : true
	});

	// 时间选择控件
	$(".datetime-apply").datetimepicker({
		format: 'yyyy-mm-dd hh:ii:00',
		startDate : new Date(),
		minuteStep: 30,
		minView : 0,
		autoclose : true
	});

	

});
