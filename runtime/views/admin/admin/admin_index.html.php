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
                                    <a href="<?php echo $add_url?>" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</a>
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
                                        <th>用户名</th>
                                        <th>姓名</th>
                                        <th>角色</th>
                                        <th>添加时间</th>
                                        <th>最后登录时间</th>
                                        <th>最后登录IP</th>
                                        <th>状态</th>
                                        <th>是否超级管理员</th>
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
                                                <input type="checkbox" data-type="icheck" name="ids[]"
                                                       value="<?php echo $value[id]?>">
                                            </label>
                                        </td>
                                        <td><?php echo $value[username]?></td>
                                        <td><?php echo $value[name]?></td>
                                        <td><?php echo $value[role]?></td>
                                        <td><?php echo $value[addtime]?></td>
                                        <td><?php echo $value[last_login_time]?></td>
                                        <td><?php echo $value[last_login_ip]?></td>
                                        <td>
                                            <div class="tpl-switch">
                                                <input type="checkbox" data-type="switch"
                                                       data-url="/admin/manager/enable" data-id="<?php echo $value[id]?>"
                                                       <?php if ( $value[enable] == 1 ) { ?>checked<?php } ?>
                                                       class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                <div class="tpl-switch-btn-view"><div></div></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tpl-switch">
                                                <input type="checkbox" data-type="switch"
                                                       data-url="/admin/manager/enable" data-id="<?php echo $value[id]?>" data-field="is_admin"
                                                       <?php if ( $value[is_admin] == 1 ) { ?>checked<?php } ?>
                                                       class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                <div class="tpl-switch-btn-view"><div></div></div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($isAdmin || in_array($edit_url,$permissions) ) {?>
                                            <a href="<?php echo $edit_url?>?id=<?php echo $value[id]?>"
                                               class="am-btn am-btn-primary am-btn-xxs am-round"
                                               href="javascript:;">
                                                <i class="am-icon-pencil"></i> 编辑
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
<script>
    seajs.use("admin", function (exports) {
        
    });
    
</script>

</body>

</html>