<?php
namespace app\admin\service;
use app\admin\dao\AdminDao;
use app\admin\dao\AdminRoleDao;
use herosphp\model\CommonService;

/**
 * 管理员角色服务
 * ----------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
class AdminRoleService extends CommonService {

    protected $modelClassName = AdminRoleDao::class;

}