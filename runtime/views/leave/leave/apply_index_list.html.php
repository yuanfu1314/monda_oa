
                            
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
                                        <th>假期类型</th>
                                        <th>员工姓名</th>
                                        <th>假期开始时间</th>
                                        <th>假期结束时间</th>
                                        <th>休假时长</th>
                                        <th>理由</th>
                                        <th>申请状态</th>
                                        <th>审核人员姓名</th>
                                        <th>审核反馈</th>
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
                                        <td><?php echo $value[leave_type]?></td>
                                        <td><?php echo $value[name]?></td>
                                        <td><?php echo $value[time_begin]?></td>
                                        <td><?php echo $value[time_end]?></td>
                                        <td><?php echo $value[duration]?></td>
                                        <td><?php echo $value[reason]?></td>
                                        <td><?php echo $value[status]?></td>
                                        <td><?php echo $value[auditor]?></td>
                                        <td><?php echo $value[comment]?></td>
                                        <td>
                                            <?php if ( $action == 'apply' ) { ?>
                                            <?php if ($isAdmin || in_array($cancel_url,$permissions) ) {?>
                                            <a data-url="<?php echo $cancel_url?>?id=<?php echo $value[id]?>"
                                               href="javascript:;" class="am-btn am-btn-danger am-btn-xxs am-round item-cancel">
                                                <i class="am-icon-ban"></i> 取消
                                            </a>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <?php if ( $value[is_show] ) { ?>
                                            <?php if ($isAdmin || in_array($agree_url,$permissions) ) {?>
                                            <a href="<?php echo $agree_url?>?id=<?php echo $value[id]?>"
                                               class="am-btn am-btn-primary am-btn-xxs am-round"
                                               href="javascript:;">
                                                <i class="am-icon-check"></i> 同意申请
                                            </a>
                                            <?php } ?>
                                            <?php if ($isAdmin || in_array($reject_url,$permissions) ) {?>
                                            <a href="<?php echo $reject_url?>?id=<?php echo $value[id]?>"
                                               class="am-btn am-btn-warning am-btn-xxs am-round"
                                               href="javascript:;">
                                                <i class="am-icon-close"></i> 拒绝申请
                                            </a>
                                            <?php } ?>
                                            <?php } ?>
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
