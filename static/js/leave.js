/**
 * 假期模块js
 * @author yangjian
 */
"use strict";
define(function(require, exports) {

    var common = require("common");
    //require("chosen");

    common.initForm("#cAdd");

    require("datepicker");

    // 时间选择控件
	$("#time_begin").datetimepicker({
		format: 'yyyy-mm-dd hh:ii',
		startDate : new Date(),
		minView : 0,
		autoclose : true
	});
	$("#time_end").datetimepicker({
		format: 'yyyy-mm-dd hh:ii',
		startDate : new Date(),
		minView : 0,
		autoclose : true
	});

});
