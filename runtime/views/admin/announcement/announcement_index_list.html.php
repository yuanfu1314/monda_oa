
                            
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
                                        <th>公告内容</th>
                                        <th>发布人</th>
                                        <th>状态</th>
                                        <th>创建时间</th>
                                        <th>修改时间</th>
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
                                        <td><?php echo $value[content]?></td>
                                        <td><?php echo $value[name]?></td>
                                        <td>
                                            <div class="tpl-switch">
                                                <input type="checkbox" data-type="switch"
                                                    data-url="/admin/announcement/enable" data-id="<?php echo $value[id]?>"
                                                    <?php if ( $value[enable] == 1 ) { ?> checked
                                                    <?php } ?>
                                                    class="ios-switch tpl-switch-btn am-margin-top-xs">
                                                <div class="tpl-switch-btn-view"><div></div></div>
                                            </div>
                                        </td>
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
                                <div class="am-fr" data-rel="pAjax"><?php echo $pageMenu?></div>
                            </div>
