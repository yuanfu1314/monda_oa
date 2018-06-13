<?php
/**
 * 管理员用户
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */

namespace app\admin\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class AdminDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('admin_user');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
        	'username' => array(Filter::DFILTER_STRING, array(1, 10), Filter::DFILTER_SANITIZE_TRIM, array('require' => '用户名不能为空.', 'length' => 'name长度必需在1-10之间.')),
            'name' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '员工姓名不能为空.', 'length' => '员工姓名长度必需在1-50之间.')),
            'password' => array(Filter::DFILTER_STRING, array(6, 32), Filter::DFILTER_SANITIZE_TRIM, array('require' => '密码不能为空', 'length' => '密码长度必需在6-32之间.')),
            'telephone' => array(Filter::DFILTER_MOBILE,  null, null, array("type" => "请输入正确的手机号码")),
            'department' => array(Filter::DFILTER_STRING, array(1, 20), Filter::DFILTER_SANITIZE_TRIM, array("require" => "部门不能为空", 'length' => '部门长度必需在1-20之间.')),
            'position' => array(Filter::DFILTER_STRING, array(1, 20), Filter::DFILTER_SANITIZE_TRIM, array("require" => "职位不能为空", 'length' => '职位长度必需在1-20之间.')),
            'leader_id' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '上司ID必须为数字.')),
            'leader_name' => array(Filter::DFILTER_STRING, null, Filter::DFILTER_SANITIZE_TRIM, null),
            'is_admin' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '是否管理者必须为数字.')),
            'enable' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '是否可用必须为数字.')),
        );
    }
} 