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
                                <form data-action="<?php echo $update_url?>" class="am-form" id="cAdd"
                                      data-location="<?php echo $index_url?>">
                                    <div class="am-form-group">
                                        <label class="am-form-label">公告内容：</label>
                                        <input type="text" name="data[content]" maxlength="200" value="<?php echo $item[content]?>" placeholder="公告内容：" required>
                                    </div>
                                    <div class="am-form-group">
                                        <input type="hidden" name="id" value="<?php echo $item[id]?>">
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
    seajs.use("admin", function (exports) {

    });

</script>

</body>

</html>