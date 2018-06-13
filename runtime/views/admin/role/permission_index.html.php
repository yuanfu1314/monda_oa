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
                                    <a href="javascript:;"
                                       class="am-btn am-btn-default am-btn-success" id="item-add"><span
                                            class="am-icon-plus"></span> 新增</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-body  am-fr">
    
                            <div class="am-g">
                                <div class="am-form-group">
                                    <div class="am-form am-form-inline search" id="search-box" role="form" >
                                        <div class="am-form-group">
                                            <input type="text" name="name" data-id="name" class="am-input-sm"
                                                   value="<?php echo $params[name]?>" placeholder="权限名称">
                                        </div>
    
                                        <div class="am-form-group">
                                            <input type="text" name="key" data-id="pkey" class="am-input-sm"
                                                   value="<?php echo $params[key]?>" placeholder="权限标志">
                                        </div>
                
                                        <div class="am-form-group">
                                            <select name="group" data-id="pgroup" class="am-input-sm"
                                                    data-am-selected="{btnWidth:'100px',btnSize:'sm'}"
                                                    placeholder="权限分组">
                                                <option value=" ">全部</option>
                                                <?php foreach ( $appConfigs[permission_group] as $key => $val ) { ?>
                                                <option value="<?php echo $key?>" <?php if ( $key==$params[group] ) { ?>selected<?php } ?>><?php echo $val?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button type="button" id="search" class="am-btn am-btn-sm am-btn-primary">搜索</button>
                                        <input type="hidden" id="index_url" data-id="index_url" value="<?php echo $index_url?>"/>
                                    </div>
        
                                </div>
                            </div>
                            <div id="list_table">
                                <?php include $this->getIncludePath('admin.role.permission_index_list')?>
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
<script type="text/html" id="role-template">
    <form data-action="{%url%}" class="am-form" id="cAdd" data-location="reload">
    
        <div class="am-form-group">
            <label class="am-form-label">权限分组：</label>
            <select name="data[pgroup]">
                <?php foreach ( $appConfigs[permission_group] as $key => $val ) { ?>
                <option value="<?php echo $key?>" {%if item.pgroup=='<?php echo $key?>'%}selected{%/if%}><?php echo $val?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="am-form-group">
            <label class="am-form-label">权限名称：</label>
            <input type="text" maxlength="20" name="data[name]" value="{%item.name%}" placeholder="请输入权限名称"
                   required>
        </div>
    
        <div class="am-form-group">
            <label class="am-form-label">权限标识：</label>
            <input type="text" name="data[pkey]" value="{%item.pkey%}" placeholder="请输入权限标识"
                   required>
        </div>
        <input type="hidden" name="id" value="{%item.id%}">
    </form>
</script>
<script>
    seajs.use("permission", function (exports) {
        
    });
    
</script>

</body>

</html>