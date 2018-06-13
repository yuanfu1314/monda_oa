/**
 * 管理员角色
 * @author yangjian
 */
"use strict";
define(function(require, exports) {

    var common = require("common");

    common.initForm("#cAdd");
    //初始化 switch 控件
    common.initSwitch();

    //添加角色
    $("#item-add").on("click", function () {
        common.post({
            title : "添加角色",
            tempId : "role-template",
            formId : "cAdd",
            data : {
                url : "/admin/role/insert",
                item : {}
            }
        });
    });

    //编辑角色
    $(".item-edit").on("click", function () {
        var id = $(this).data("id");
        $.get("/admin/role/edit/?id="+id, function (res) {
            if (res.code != "000") {
                common.errorMessage(res.message);
            } else {
	            common.post({
		            title : "编辑角色",
		            tempId : "role-template",
		            formId : "cAdd",
		            data : {
			            url : "/admin/role/update",
                        item : res.data.item || {}
		            }
	            });
            }
        }, "json");
    });

    //修改权限
	$(".permission-edit").on("click", function () {

		var id = $(this).data("id");
		$.get("/admin/role/getPermissions?id="+id, function (res) {

			if (res.code == "000") {
				common.post({
					title : "修改角色权限",
					width : 800,
					height: 80,
					tempId : "permission-template",
					formId : "permission-form",
					data : {
						url : "/admin/role/savePermissions",
						list : res.data.items,
						selected : res.data.item || {}
					}
				});
				$('input[data-type="icheck"]').uCheck();
				$("#role-id").val(id);

				$(".p-check-all").on("change", function () {
					if (this.checked) {
						$(this).closest("h3").next().find('input[data-type="icheck"]').uCheck('check');
					} else {
						$(this).closest("h3").next().find('input[data-type="icheck"]').uCheck('uncheck');
					}
				});

				//初始化全选 checkbox 的选中状态
				$('.p-check-all').each(function (idx, ele) {
					var total = $(ele).closest("h3").next().find('input[data-type="icheck"]').length;
					var checked = $(ele).closest("h3").next().find('input[data-type="icheck"]:checked').length;
					if (checked > 0 && checked == total) {
						$(ele).uCheck('check');
					}
				});

			} else {
				common.errorMessage(common.global.errorMsg)
			}
		}, "json");
	});
});
