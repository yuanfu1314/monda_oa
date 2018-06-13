<?php

/**
 * 后台菜单
* @author YuanFu<yuanf@pvc123.com>
* @date 2018-06-06

 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class AdminMenuDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('admin_menu');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
        	'p_id' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '父级菜单ID必须为数字.')),
            'name' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '菜单不能为空.', 'length' => '菜单名称长度必需在1-50之间.')),
            'url' => array(Filter::DFILTER_STRING, array(1, 100), Filter::DFILTER_SANITIZE_TRIM, array('require' => '菜单url不能为空', 'length' => '密码长度小于100.')),
            'permission' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '菜单权限不能为空.', 'length' => '菜单权限必需在1-50之间.')),
            'sort' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '排序必须为数字.')),
            'enable' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '是否可用必须为数字.')),
        );

    }

}