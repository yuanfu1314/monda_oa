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
                                        <label class="am-form-label">用户名：</label>
                                        <input type="text" maxlength="20" name="data[username]" placeholder="输入用户名 6-20"
                                               class="js-ajax-validate" data-url="/admin/manager/exists/"
                                               data-name="username"
                                               data-validation-message="用户名已经被注册,请更换." required>
                                    </div>
    
                                    <div class="am-form-group">
                                        <label class="am-form-label">角色：</label>
                                        <select name="rids" 
                                                data-placeholder="请选择角色">
                                            <?php foreach ( $roles as $value ) { ?>
                                            <option value="<?php echo $value[id]?>"><?php echo $value[name]?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
    
                                    <div class="am-form-group">
                                        <label class="am-form-label">姓名：</label>
                                        <input type="text" name="data[name]" placeholder="输入姓名" required>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label class="am-form-label">密码：</label>
                                        <input type="password" name="data[password]" minlength="6" maxlength="20"
                                               id="password" placeholder="请输入密码 6-20" required>
                                    </div>
    
                                    <div class="am-form-group">
                                        <label class="am-form-label">确认密码：</label>
                                        <input type="password" name="repass" minlength="6" maxlength="20"
                                               placeholder="请确认密码"
                                               data-equal-to="#password" data-validation-message="请输入跟上面一致的密码" required>
                                    </div>
    
                                    <div class="am-form-group">
                                        <label>状态：</label>
                                        <label class="am-radio-inline"><input type="radio" value="1" name="data[enable]"
                                                                              data-type="icheck" checked> 启用</label>
                                        <label class="am-radio-inline"><input type="radio" value="0" name="data[enable]"
                                                                              data-type="icheck"> 禁用</label>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label>是否超级管理员：</label>
                                        <label class="am-radio-inline"><input type="radio" value="1" name="data[is_admin]"
                                                                              data-type="icheck" checked> 启用</label>
                                        <label class="am-radio-inline"><input type="radio" value="0" name="data[is_admin]"
                                                                              data-type="icheck"> 禁用</label>
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
    seajs.use("admin", function (exports) {
        
    });

</script>

</body>

</html>