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
                                    <a href="<?php echo $add_url?>" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 申请</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="widget-body  am-fr">
                            <div class="am-g">
                                <div class="am-form-group">
                                    <form class="am-form am-form-inline search" id="search-box">
                                        <div class="am-form-group">
                                            <select name="enable" class="am-input-sm" data-id="enable"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="状态">
                                                <option value="">全部</option>
                                                <option value="0">禁用</option>
                                                <option value="1">启用</option>
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
                                                   value="" placeholder="发布人姓名">
                                        </div>
                                        <button type="button" id="search" class="am-btn am-btn-sm am-btn-primary">搜索</button>
                                        <input type="hidden" id="index_url" data-id="index_url" value="<?php echo $index_url?>"/>
                                    </form>
        
                                </div>
                            </div>
                            <div id="list_table">
                                <?php include $this->getIncludePath('admin.announcement.announcement_index_list')?>
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