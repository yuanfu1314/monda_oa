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
                                    <a href="<?php echo $add_url?>" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</a>
                                </div>
                            </div>
                            
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
                                        <th>物品</th>
                                        <th>备注说明</th>
                                        <th>添加时间</th>
                                        <th>更新时间</th>
                                        <th></th>
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
                                        <td><?php echo $value[goods]?></td>
                                        <td><?php echo $value[remark]?></td>
                                        <td><?php echo $value[addtime]?></td>
                                        <td><?php echo $value[updatetime]?></td>
                                        <td>
                                            <a href="<?php echo $edit_url?>?id=<?php echo $value[id]?>"
                                               class="am-btn am-btn-primary am-btn-xxs am-round"
                                               href="javascript:;">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a data-url="<?php echo $delete_url?>?id=<?php echo $value[id]?>"
                                               href="javascript:;" class="am-btn am-btn-danger am-btn-xxs am-round item-delete">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
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
    seajs.use("office", function (exports) {
        
    });
    
</script>

</body>

</html>