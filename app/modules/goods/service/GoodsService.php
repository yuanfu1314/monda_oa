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
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class GoodsService extends CommonService {

    protected $modelClassName = GoodsDao::class;

}