<?php
namespace app\leave\service;
use app\leave\dao\LeaveDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;

/**
 * 假期服务
 * ----------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class LeaveService extends CommonService {

    protected $modelClassName = LeaveDao::class;

}