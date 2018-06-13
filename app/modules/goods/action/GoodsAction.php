<?php
namespace app\goods\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\goods\service\GoodsService;
use app\goods\service\GoodsApplyService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 物品控制器
 * @author  yuanfu<yuanf@pvc123.com>
 */
class GoodsAction extends CommonAction {

    protected $serviceClass = GoodsService::class;

    protected $actionTitle = "物品";

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        parent::index($request);
        $this->setOpt($this->actionTitle.'列表');
        $this->setView("goods/goods_index");

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'添加');
        $this->setView('goods/goods_add');
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $this->setView('goods/goods_edit');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        //物品是否唯一
        $unique = parent::checkExist('goods', $data['goods']);
        if ($unique == true) {
            JsonResult::fail(Lang::GOODS_FAIL);
        }
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        $id = $request->getParameter('id', 'intval');
        //物品是否唯一
        $unique = parent::checkExist('goods', $data['goods'], 'id', '!=', $id);
        if ($unique == true) {
            JsonResult::fail(Lang::GOODS_FAIL);
        }
        parent::_update($data, $id);
    }

    /**
     * 删除单条数据
     * @param HttpRequest $request
     * @param 回调函数 $callback
     */
    public function delete( HttpRequest $request, $callback = null) {

        $id = $request->getParameter('id', 'trim');
        if ( empty($id) ) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        }
        $service = Loader::service(GoodsApplyService::class);
        $item = $service->fields('id')->where('goods_id',$id)->findOne();
        if (!empty($item['id'])) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_GOODS_FAIL);
        }
        if ( $this->service->delete($id) ) {
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    }
}