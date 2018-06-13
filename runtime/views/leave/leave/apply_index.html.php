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
                            <?php if ($isAdmin || in_array($add_url,$permissions) ) {?>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="<?php echo $add_url?>" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 申请</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="widget-body  am-fr">
                            <?php include $this->getIncludePath('leave.leave.apply_index_search')?>
                            <div id="list_table">
                                <?php include $this->getIncludePath('leave.leave.apply_index_list')?>
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
    seajs.use("leave", function (exports) {
        
    });
    
</script>

</body>

</html>