
                            <div class="am-g">
                                <div class="am-form-group">
                                    <form class="am-form am-form-inline search" id="search-box">
                                        <div class="am-form-group">
                                            <select name="office" data-id="office" class="am-input-sm"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="办公室">
                                                    <option value="">全部</option>
                                                <?php foreach ( $offices as $key => $val ) { ?>
                                                <option value="<?php echo $val[id]?>"><?php echo $val['office']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="am-form-group">
                                            <select name="status" class="am-input-sm" data-id="status"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="申请状态">

                                                <option value="">全部</option>
                                                <option value="0">已申请</option>
                                                <option value="1">正在使用</option>
                                                <option value="2">申请过期</option>
                                                <option value="3">关闭申请</option>
                                                <option value="4">拒绝申请</option>

                                            </select>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" id="time_begin_start" data-id="time_begin_start" name="time_begin_start" placeholder="开始使用时间，起始时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" id="time_begin_end" data-id="time_begin_end" name="time_begin_end" placeholder="开始使用时间，结束时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" id="time_end_start" data-id="time_end_start" name="time_end_start" placeholder="结束使用时间，起始时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <div class="am-input-group">
                                                <input type="text" class="datetime" id="time_end_end" data-id="time_end_end" name="time_end_end" placeholder="结束使用时间，结束时间" />
                                                <a class="am-input-group-btn">
                                                    <button class="am-btn am-btn-default" type="button">
                                                        <i class="icon-th am-icon-clock-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="am-form-group">
                                            <input type="text" name="name" data-id="name" class="am-input-sm"
                                                   value="<?php echo $params[name]?>" placeholder="申请人员姓名">
                                        </div>
                                        <button type="button" id="search" class="am-btn am-btn-sm am-btn-primary">搜索</button>
                                        <input type="hidden" id="index_url" data-id="index_url" value="<?php echo $index_url?>"/>
                                    </form>
        
                                </div>
                            </div>
                            