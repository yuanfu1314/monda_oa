<?php

/**
 * 物品申请
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
namespace app\goods\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class GoodsApplyDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('goods_apply');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
        	'goods_id' => array(Filter::DFILTER_NUMERIC, null, null,
                array('type' => '物品ID必须为数字.')),
        	'goods' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '物品不能为空.', 'length' => '物品长度必需在1-50之间.')),
        	'staff_id' => array(Filter::DFILTER_NUMERIC, null, null,
                array('type' => '员工ID必须为数字.')),
            'name' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '员工姓名不能为空.', 'length' => '员工姓名长度必需在1-50之间.')),
            'reason' => array(Filter::DFILTER_STRING, array(1, 100), Filter::DFILTER_SANITIZE_TRIM, array("require" => "理由不能为空", 'length' => '理由长度必需在1-100之间.')),
            'status' => array(Filter::DFILTER_NUMERIC, null, null, array('type' => '申请状态必须为数字.')),
            'auditor_id' => array(Filter::DFILTER_NUMERIC, null, null, null),
            'auditor' => array(Filter::DFILTER_STRING, null, Filter::DFILTER_SANITIZE_TRIM, null),
            'comment' => array(Filter::DFILTER_STRING, null, Filter::DFILTER_SANITIZE_TRIM, null),
        );


    }

}