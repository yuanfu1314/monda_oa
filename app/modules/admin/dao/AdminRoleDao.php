<?php

/**
 * 管理员用户角色
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class AdminRoleDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('admin_role');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
            'name' => array(Filter::DFILTER_STRING, array(1, 20), Filter::DFILTER_SANITIZE_TRIM, array('require' => '角色名称不能为空.', 'length' => '角色名称长度必需在1-20之间.')),
            'permission' => array(Filter::DFILTER_STRING, null, Filter::DFILTER_SANITIZE_TRIM, null),
            'enable' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '是否可用必须为数字.')),
        );

    }

}