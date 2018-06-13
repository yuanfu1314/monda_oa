<?php

/**
 * 管理员用户角色权限
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class AdminPermissionDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('admin_permissions');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
        	'pgroup' => array(Filter::DFILTER_STRING, array(1, 30), Filter::DFILTER_SANITIZE_TRIM, array('require' => '模块分组不能为空.', 'length' => '模块分组长度必需在1-30之间.')),
            'name' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '权限名称不能为空.', 'length' => '权限名称长度必需在1-50之间.')),
            'pkey' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '权限标识不能为空', 'length' => '权限标识长度必需在1-50之间.')),
        );

    }

}