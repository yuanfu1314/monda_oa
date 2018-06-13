<?php

/**
 * 办公室
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
namespace app\office\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class OfficeDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('office');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
            'goods' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '办公室不能为空.', 'length' => '办公室长度必需在1-50之间.')),
            'remark' => array(Filter::DFILTER_STRING, array(1, 200), Filter::DFILTER_SANITIZE_TRIM, array('require' => '备注说明不能为空.', 'length' => '备注说明必需在1-200之间.')),
        );

    }

}