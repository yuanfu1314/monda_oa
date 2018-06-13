<?php

/**
 * 假期类型
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
namespace app\leave\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class LeaveDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('leave_type');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
            'leave_type' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '假期类型不能为空.', 'length' => '假期类型长度必需在1-50之间.')),
            'remark' => array(Filter::DFILTER_STRING, array(1, 200), Filter::DFILTER_SANITIZE_TRIM, array('require' => '备注说明不能为空.', 'length' => '备注说明必需在1-200之间.')),
        );

    }

}