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
                            <div class="widget-title  am-cf" th:text="${title}"></div>
                        </div>
                        <div class="widget-body  am-fr">
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                    员工编号： <?php echo $loginUser->getUserName()?>
                                </div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                    姓名： <?php echo $loginUser->getName()?>
                                </div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                   手机号码： <?php echo $loginUser->getTelephone()?>
                                </div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                    部门： <?php echo $loginUser->getDepartment()?>
                                </div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                    职位： <?php echo $loginUser->getPosition()?>
                                </div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-sm-3 am-u-md-3">
                                    直属上司： <?php echo $loginUser->getLeaderName()?>
                                </div>        
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="am-u-lg-12">
                    <div th:replace="admin/include :: footer">Monda Group 2018</div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php include $this->getIncludePath('admin.inc.res')?>

<?php echo $this->importResource('js', "common/js/vue.js")?>


</body>

</html>