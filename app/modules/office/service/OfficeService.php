<?php
namespace app\office\service;
use app\office\dao\OfficeDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;

/**
 * 办公室服务
 * ----------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class OfficeService extends CommonService {

    protected $modelClassName = OfficeDao::class;

}