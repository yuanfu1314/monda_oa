
                            <div class="am-g">
                                <div class="am-form-group">
                                    <form class="am-form am-form-inline search" id="search-box">
                                        <div class="am-form-group">
                                            <select name="goods" data-id="goods" class="am-input-sm"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="物品">
                                                    <option value="">全部</option>
                                                <?php foreach ( $goods as $key => $val ) { ?>
                                                <option value="<?php echo $val[id]?>"><?php echo $val['goods']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="am-form-group">
                                            <select name="status" class="am-input-sm" data-id="status"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="申请状态">
                                                <option value="">全部</option>
                                                <option value="0">申请中</option>
                                                <option value="1">已领取</option>
                                                <option value="2">拒绝</option>
                                                <option value="3">取消</option>
                                            </select>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" data-id="time_begin" name="time_begin" placeholder="起始时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" data-id="time_end" name="time_end" placeholder="结束时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <input type="text" name="name" data-id="name" class="am-input-sm"
                                                   value="" placeholder="申请人员姓名">
                                        </div>
                                        <button type="button" id="search" class="am-btn am-btn-sm am-btn-primary">搜索</button>
                                        <input type="hidden" id="index_url" data-id="index_url" value="<?php echo $index_url?>"/>
                                    </form>
        
                                </div>
                            </div>
                            