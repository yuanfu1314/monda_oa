
<!-- 菜单 -->
<div>
    <!-- 风格切换 -->
    <div class="tpl-skiner">
        <div class="tpl-skiner-toggle am-icon-cog">
        </div>
        <div class="tpl-skiner-content">
            <div class="tpl-skiner-content-title">
                选择主题
            </div>
            <div class="tpl-skiner-content-bar">
                <span class="skiner-color skiner-white" data-color="theme-white"></span>
                <span class="skiner-color skiner-black" data-color="theme-black"></span>
            </div>
        </div>
    </div>
    <!-- 侧边导航栏 -->
    <div class="left-sidebar">
        
        <!-- 菜单 -->
        <ul class="sidebar-nav" id="sidebar-nav">

            <?php foreach ( $adminMenus as $value ) { ?>
            <li class="sidebar-nav-link">
                <a href="javascript:;" class="sidebar-nav-sub-title">
                    <i class="am-icon-table sidebar-nav-link-logo"></i> <span><?php echo $value[name]?></span>
                    <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico sidebar-nav-sub-ico-rotate"></span>
                </a>
                
                <ul class="sidebar-nav sidebar-nav-sub">
                    <?php foreach ( $value[subs] as $val ) { ?>
                    <?php if ($isAdmin || in_array(strtolower($val[url]),$permissions) ) {?>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo $val[url]?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span> <span><?php echo $val[name]?></span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
        
        </ul>
    </div>
</div>