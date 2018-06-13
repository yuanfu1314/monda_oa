<?php
namespace app\goods\service;
use app\goods\dao\GoodsDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;

/**
 * 物品服务
 * ----------------
 * @author yuanfu<yuanf@pvc123.com>
 */
class GoodsService extends CommonService {

    protected $modelClassName = GoodsDao::class;

}