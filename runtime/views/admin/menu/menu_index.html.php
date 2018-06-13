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

                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button id="item-add" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-body  am-fr">
                            
                            <div class="am-g">
                                <form id="cList">
                                <table width="100%" class="am-table am-table-compact am-table-hover tpl-table-black am-table-bordered" id="clist-table">
                                    <thead>
                                    <tr>
                                        <th>菜单名称</th>
                                        <th>菜单URL</th>
                                        <th>菜单权限</th>
                                        <th>是否启用</th>
                                        <th>排序</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if ( empty($items) ) { ?>
                                    <tr><td class="empty-td">暂无记录.</td></tr>
                                    <?php } ?>
                                    
                                    <?php foreach ( $items as $value ) { ?>
                                        <tr class="gradeX">
                                            <td><?php echo $value[name]?></td>
                                            <td><?php echo $value[url]?></td>
                                            <td><!--菜单权限--></td>
                                            <td>
                                                <div class="tpl-switch">
                                                    <input <?php if ( $value[enable]==1 ) { ?>checked<?php } ?> type="checkbox"
                                                           data-type="switch"
                                                           data-url="/admin/menu/enable"
                                                           data-id="<?php echo $value[id]?>"
                                                           class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                    <div class="tpl-switch-btn-view"><div></div></div>
                                                </div>
                                            </td>
                                            <td><?php echo $value[sort]?></td>
                                            <td><?php echo $value[addtime]?></td>
                                            <td>
                                                <a href="javascript:;" data-id="<?php echo $value[id]?>"
                                                   class="am-btn am-btn-primary am-btn-xxs am-round item-edit">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
    
                                                <a href="javascript:;" data-id="<?php echo $value[id]?>"
                                                   class="am-btn am-btn-secondary am-btn-xxs am-round add-sub-item">
                                                    <i class="am-icon-plus"></i> 添加子菜单
                                                </a>
                                                
                                                <a data-url="<?php echo $delete_url?>?id=<?php echo $value[id]?>"
                                                   href="javascript:;" class="am-btn am-btn-danger am-btn-xxs am-round item-delete">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </td>
                                        </tr>

                                        <?php foreach ( $value[subs] as $val ) { ?>
                                        <tr class="gradeX">
                                            <td>|-- <?php echo $val[name]?></td>
                                            <td><?php echo $val[url]?></td>
                                            <td><?php echo $val[permission]?></td>
                                            <td>
                                                <div class="tpl-switch">
                                                    <input <?php if ( $val[enable]==1 ) { ?>checked<?php } ?> type="checkbox"
                                                           data-type="switch"
                                                           data-url="/admin/menu/enable"
                                                           data-id="<?php echo $val[id]?>"
                                                           class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                    <div class="tpl-switch-btn-view"><div></div></div>
                                                </div>
                                            </td>
                                            <td><?php echo $val[sort]?></td>
                                            <td><?php echo $val[addtime]?></td>
                                            <td>
                                                <a href="javascript:;" data-id="<?php echo $val[id]?>"
                                                   class="am-btn am-btn-primary am-btn-xxs am-round item-edit">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>

                                                <a data-url="<?php echo $delete_url?>?id=<?php echo $val[id]?>"
                                                   href="javascript:;" class="am-btn am-btn-danger am-btn-xxs am-round item-delete">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>

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
            <label class="am-form-label">上级菜单：</label>
            <select name="data[pid]">
                <option value="0">顶级菜单</option>
                <?php foreach ( $menus as $value ) { ?>
                <option value="<?php echo $value[id]?>" {%if item.pid==<?php echo $value[id]?>%}selected{%/if%}><?php echo $value[name]?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="am-form-group">
            <label class="am-form-label">菜单名称：</label>
            <input type="text" maxlength="30" name="data[name]" value="{%item.name%}" placeholder="请输入菜单名称"
                   required>
        </div>
        
        <div class="am-form-group">
            <label class="am-form-label">菜单URL：</label>
            <input type="text" name="data[url]" value="{%item.url%}" placeholder="请输入菜单URL">
        </div>
    
        <div class="am-form-group">
            <label class="am-form-label">菜单权限标识(需要什么权限才能看到此菜单)：</label>
            <input type="text" name="data[permission]" value="{%item.permission%}" placeholder="请输入菜单权限标识">
        </div>
    
        <div class="am-form-group">
            <label class="am-form-label">菜单排序：</label>
            <input type="number" name="data[sort]" value="{%item.sort%}" placeholder="请输入菜单排序,越大越靠后"
                   required>
        </div>
        
        <input type="hidden" name="id" value="{%item.id%}">
    </form>
</script>

<script>
    seajs.use("menu", function (exports) {
        
    });
    
</script>

</body>

</html>