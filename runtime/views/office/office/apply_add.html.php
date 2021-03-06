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
                            
                            <div class="am-u-sm-12">
                                <form data-action="<?php echo $insert_url?>" class="am-form" id="cAdd"
                                      data-location="<?php echo $index_url?>">
                                    <div class="am-form-group">
                                        <select name="data[office_id]" class="am-input-sm"
                                                data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                placeholder="办公室">
                                            <?php foreach ( $offices as $key => $val ) { ?>
                                            <option value="<?php echo $val[id]?>"><?php echo $val['office']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group">
                                        <label>开始使用时间：</label>
                                        <div class="am-input-group">
                                            <input type="text" class="datetime-apply" id="time_begin" name="data[time_begin]" placeholder="请选择时间"  required/>
                                            <a class="am-input-group-btn">
                                                <button class="am-btn am-btn-default" type="button">
                                                    <i class="icon-th am-icon-clock-o"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label>结束使用时间：</label>
                                        <div class="am-input-group">
                                            <input type="text" class="datetime-apply" id="time_end" name="data[time_end]" placeholder="请选择时间" required/>
                                            <a class="am-input-group-btn">
                                                <button class="am-btn am-btn-default" type="button">
                                                    <i class="icon-th am-icon-clock-o"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-form-label">申请理由：</label>
                                        <input type="text" name="data[reason]" placeholder="申请理由" required/>
                                    </div>
    
                                    <div class="am-form-group">
                                        <button type="submit" class="am-btn am-btn-primary">提交保存</button>
                                    </div>
                                    
                                </form>
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