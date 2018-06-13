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
                        </div>
                        <div class="widget-body  am-fr">
                            
                            <div class="am-g">
                                <div class="am-form-group">
                                    <form class="am-form am-form-inline search" id="search-box">
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
                                            <input type="text" name="name" data-id="name" class="am-input-sm"
                                                   value="<?php echo $params[name]?>" placeholder="申请人员姓名">
                                        </div>
                                        <button type="button" id="search" class="am-btn am-btn-sm am-btn-primary">搜索</button>
                                        <input type="hidden" id="index_url" data-id="index_url" value="<?php echo $index_url?>"/>
                                    </form>
        
                                </div>
                            </div>
                            <div id="list_table">
                                <?php include $this->getIncludePath('goods.goods.apply_index_list')?>
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
    seajs.use("goods", function (exports) {
        
    });
    
</script>

</body>

</html>