
                            
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
                                        <th>权限名称</th>
                                        <th>权限分组</th>
                                        <th>权限标识</th>
                                        <th>添加时间</th>
                                        <th>更新时间</th>
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
                                        <td><?php echo $value[name]?></td>
                                        <td><?php echo $value[groupName]?></td>
                                        <td><?php echo $value[pkey]?></td>
                                        <td><?php echo $value[addtime]?></td>
                                        <td><?php echo $value[updatetime]?></td>
                                        <td>
                                            <?php if ($isAdmin || in_array($edit_url,$permissions) ) {?>
                                            <a class="am-btn am-btn-primary am-btn-xxs am-round item-edit"
                                               data-id="<?php echo $value[id]?>"
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
