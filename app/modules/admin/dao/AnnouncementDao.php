<?php

/**
 * 公告
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;
use herosphp\filter\Filter;

class AnnouncementDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('announcement');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';
        $this->filterMap = array(
        	'staff_id' => array(Filter::DFILTER_NUMERIC, null, null,
                array('type' => '员工ID必须为数字.')),
            'name' => array(Filter::DFILTER_STRING, array(1, 50), Filter::DFILTER_SANITIZE_TRIM, array('require' => '员工姓名不能为空.', 'length' => '员工姓名长度必需在1-50之间.')),
            'content' => array(Filter::DFILTER_STRING, null, Filter::DFILTER_SANITIZE_TRIM, array('require' => '公告内容不能为空')),
            'enable' => array(Filter::DFILTER_NUMERIC, null, null,
                array('type' => '是否可用必须为数字.')),
        );

    }

}