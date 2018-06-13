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
                                        <label class="am-form-label">用户名：</label>
                                        <input type="text" maxlength="20" value="<?php echo $item[username]?>" readonly>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-form-label">角色：</label>
                                        <select name="rids"  data-placeholder="请选择角色">
                                            <?php foreach ( $roles as $value ) { ?>
                                            <option value="<?php echo $value[id]?>"
                                                    <?php if ( $value[id] == $roleIds ) { ?>selected<?php } ?>><?php echo $value[name]?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-form-label">姓名：</label>
                                        <input type="text" name="data[name]" value="<?php echo $item[name]?>" placeholder="输入姓名"
                                               required>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-form-label">密码：</label>
                                        <input type="password" name="password"
                                               id="password" placeholder="不修改密码请留空">
                                    </div>

                                    <div class="am-form-group">
                                        <label>状态：</label>
                                        <label class="am-radio-inline">
                                            <input type="radio" value="1"
                                                   name="data[enable]"
                                                   <?php if ( $item[enable] == 1 ) { ?>checked<?php } ?>
                                                   data-type="icheck" checked> 启用</label>
                                        <label class="am-radio-inline">
                                            <input type="radio" value="0"
                                                   name="data[enable]"
                                                   <?php if ( $item[enable] == 0 ) { ?>checked<?php } ?>
                                                   data-type="icheck"> 禁用</label>
                                    </div>


                                    <div class="am-form-group">
                                        <input type="hidden" name="id" value="<?php echo $item[id]?>">
                                        <input type="hidden" name="data[salt]" value="<?php echo $item[salt]?>">
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