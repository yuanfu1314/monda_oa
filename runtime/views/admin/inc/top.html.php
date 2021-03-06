<!-- 页面顶部 -->
<div>
    <header>
        <div class="am-fl tpl-header-logo">
            <a href="javascript:;"><img src="/static/admin/img/oa_small.png" alt="" /></a>
        </div>
        
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-switch-button am-icon-list"><span></span></div>
            
            <!-- 搜索 -->
            <div class="am-fl" id="scroll_text">
            </div>
            
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <li class="am-text-sm tpl-header-navbar-welcome am-dropdown " data-am-dropdown="">
                        <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle="">
                            欢迎你, <span><?php echo $loginUser->getName()?></span>
                            <span class="am-icon-caret-down"></span>
                        </a>
                        <ul class="am-dropdown-content">
                            <li><a href="#" id="modify-pass">
                                <span class="am-icon-lock"></span> 修改密码</a></li>
                            <li>
                                <a href="/admin/login/logout">
                                    <span class="am-icon-sign-out"></span> 退出
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- 修改密码模板 -->
                    <script type="text/html" id="modify-password-template">
                        <form data-action="/admin/manager/modifyPass" class="am-form" id="modify-pass-form"
                              data-location="/admin/login/index">
        
                            <div class="am-form-group">
                                <label class="am-form-label">原始密码：</label>
                                <input type="password" name="oldpass" placeholder="请输入原始密码" required>
                            </div>
        
                            <div class="am-form-group">
                                <label class="am-form-label">密码：</label>
                                <input type="password" name="newpassword" minlength="6" maxlength="20"
                                       id="newpassword" placeholder="请输入密码 6-20" required>
                            </div>
        
                            <div class="am-form-group">
                                <label class="am-form-label">确认密码：</label>
                                <input type="password" name="repass" minlength="6" maxlength="20" placeholder="请输入确认密码"
                                       data-equal-to="#newpassword" data-validation-message="请输入跟上面一致的密码" required>
                            </div>
    
                        </form>
                    </script>
                </ul><!-- end of ul.am-fr -->
                
            </div>
        </div>
    
    </header>
</div>