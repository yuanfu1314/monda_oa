<?php include $this->getIncludePath('admin.inc.header')?>

<body>

<div class="am-g tpl-g">

    <?php include $this->getIncludePath('admin.inc.top')?>


    <?php include $this->getIncludePath('admin.inc.leftmenu')?>
    
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="widget am-cf">
                <div class="widget-body">
                    <div class="tpl-page-state">
                        <div class="tpl-page-state-title am-text-center tpl-error-title">403</div>
                        <div class="tpl-error-title-info">Subject does not have permission</div>
                        <div class="tpl-page-state-content tpl-error-content">
                            
                            <p>对不起,您没有权限访问该页面，请联系管理员授权。</p>
                            <a href="/admin/index" class="am-btn am-btn-secondary am-radius tpl-error-btn">返回首页
                            </a></div>
                    
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
<?php include $this->getIncludePath('admin.inc.res')?>

<script>
    seajs.use("common");
</script>

</body>

</html>