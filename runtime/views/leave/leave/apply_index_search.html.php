
                            <div class="am-g">
                                <div class="am-form-group">
                                    <form class="am-form am-form-inline search" id="search-box">
                                        <div class="am-form-group">
                                            <select name="status" class="am-input-sm" data-id="status"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="申请状态">
                                                <option value="">全部</option>
                                                <option value="0">申请中</option>
                                                <option value="1">同意申请</option>
                                                <option value="2">拒绝申请</option>
                                                <option value="3">取消申请</option>

                                            </select>
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
                        