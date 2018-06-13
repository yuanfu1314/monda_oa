<?php include $this->getIncludePath('admin.inc.header')?>

<body>

<div class="am-g tpl-g">

    <?php include $this->getIncludePath('admin.inc.top')?>


    <?php include $this->getIncludePath('admin.inc.leftmenu')?>
    
    <!-- content goes here -->
    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf"><?php echo $optTitle?></div>
                            <?php if ($isAdmin || in_array($add_url,$permissions) ) {?>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="javascript:;"
                                       class="am-btn am-btn-default am-btn-success" id="item-add"><span
                                            class="am-icon-plus"></span> 新增</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="widget-body  am-fr">
                            
                            <div class="am-g">
                                <form id="cList">
                                <table width="100%" class="am-table am-table-compact am-table-hover tpl-table-black am-table-bordered" id="clist-table">
                                    <thead>
                                    <tr>
                                        <th class="list-checkbox-th">
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" data-type="icheck" id="check-all" value="0">
                                            </label>
                                        </th>
                                        <th>角色名称</th>
                                        <th>添加时间</th>
                                        <th>更新时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if ( empty($items) ) { ?>
                                    <tr><td class="empty-td">暂无记录.</td></tr>
                                    <?php } ?>

                                    <?php foreach ( $items as $value ) { ?>
                                    <tr class="gradeX">
                                        <td class="list-checkbox-th">
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" data-type="icheck" name="ids[]"  value="<?php echo $value[id]?>">
                                            </label>
                                        </td>
                                        <td><?php echo $value[name]?></td>
                                        <td><?php echo $value[addtime]?></td>
                                        <td><?php echo $value[updatetime]?></td>
                                        <td>
                                            <div class="tpl-switch">
                                                <input type="checkbox"
                                                       <?php if ( $value[enable] == 1 ) { ?>checked<?php } ?>
                                                       data-type="switch"
                                                       data-url="/admin/role/enable"
                                                       data-id="<?php echo $value[id]?>"
                                                       class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                <div class="tpl-switch-btn-view" title="禁用"><div></div></div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($isAdmin || in_array($edit_url,$permissions) ) {?>
                                            <a class="am-btn am-btn-primary am-btn-xxs am-round item-edit"
                                               data-id="<?php echo $value[id]?>"
                                               href="javascript:;">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <?php } ?>
                                            <?php if ($isAdmin || in_array($auth_url,$permissions) ) {?>
                                            <a class="am-btn am-btn-secondary am-btn-xxs am-round permission-edit"
                                               data-id="<?php echo $value[id]?>"
                                               href="javascript:;">
                                                <i class="am-icon-edit"></i> 修改权限
                                            </a>
                                            <?php } ?>
                                            <?php if ($isAdmin || in_array($delete_url,$permissions) ) {?>
                                            <a data-url="<?php echo $delete_url?>?id=<?php echo $value[id]?>"
                                               href="javascript:;" class="am-btn am-btn-danger am-btn-xxs am-round item-delete">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <!-- more data -->
                                    </tbody>
                                </table>
                                </form>
                            </div>

                            <div class="am-g am-cf">
                                <div class="am-fr"><?php echo $pageMenu?></div>
                            </div>

                        </div>
                    </div>
                </div>
    
                <div class="am-u-lg-12">
                    <?php include $this->getIncludePath('admin.inc.footer')?>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
<?php include $this->getIncludePath('admin.inc.res')?>
<script type="text/html" id="role-template">
    <form data-action="{%url%}" class="am-form" id="cAdd" data-location="reload">
        <div class="am-form-group">
            <label class="am-form-label">角色名称：</label>
            <input type="text" maxlength="20" name="data[name]" value="{%item.name%}" placeholder="请输入角色名称"
                   required>
        </div>
        <input type="hidden" name="id" value="{%item.id%}">
    </form>
</script>

<!-- 修改权限 -->
<script type="text/html" id="permission-template">
    <form data-action="{%url%}" class="am-form" id="permission-form" data-location="reload">
        {%each list as plist%}
        <div class="am-form-group">
            <h3 style="border-bottom: 1px solid #e1e1e1; padding-bottom: 5px; margin-bottom: 5px;">
                <label class="am-checkbox-inline am-success">
                    <input type="checkbox" data-type="icheck" class="p-check-all am-novalidate" />
                    <strong>{%plist.groupName%}</strong>
                </label>
            </h3>
            <div class="p-container">
                {%each plist.permissionList as p%}
                <label class="am-checkbox-inline" style="margin-left: 0; margin-right: 10px; margin-bottom: 5px;">
                    <input type="checkbox" name="permissions[{%p.pkey%}]"  value="1" data-type="icheck"
                           {%if selected[p.pkey]%}checked{%/if%}
                    class="am-novalidate">
                    {%p.name%}
                </label>
                {%/each%}
            </div>
        </div>
        {%/each%}
        
        <input type="hidden" name="roleId" id="role-id">
    </form>
</script>

<script>
    seajs.use("role");
</script>

</body>

</html>