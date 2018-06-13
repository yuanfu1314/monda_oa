/**
 * 模块js
 * @author yuanfu<yuanf@pvc123.com>
 */
"use strict";
define(function(require, exports) {

    var common = require("common");

    common.initForm("#cAdd");

    require("datepicker");

    // 时间选择控件
	$(".datetime").datetimepicker({
		format: 'yyyy-mm-dd hh:ii:00',
		minuteStep: 30,
		minView : 0,
		autoclose : true
	});

});
