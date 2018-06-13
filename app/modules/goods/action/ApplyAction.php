<?php
namespace app\goods\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\goods\service\GoodsApplyService;
use app\goods\service\GoodsService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 物品申请控制器
 * @author  Yuanfu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
class ApplyAction extends CommonAction {

    protected $serviceClass = GoodsApplyService::class;

    protected $actionTitle = "物品申请";

    protected $goods_status_remark = array(
        '0' => '申请中',
        '1' => '已领取',
        '2' => '拒绝',
        '3' => '取消'
    );
    const APPLY = 0;
    const RECEIVED = 1;
    const REJECT = 2;
    const CANCEL = 3;
    const ACTION = 'apply';

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        $search_data = $request->getParameter('search_data');
        $is_ajax = $request->getParameter('is_ajax');
        //数据查询
        $this->service->search_data($search_data);
        $this->service->where('staff_id', $this->loginUser->getId());
        parent::index($request);

        $items = $this->getTemplateVar('items');

        foreach ($items as $key => $item) {
            $items[$key]['status'] = isset($this->goods_status_remark[$item['status']])? $this->goods_status_remark[$item['status']] : '';
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $goods = $this->service->loadGoods();
        $this->assign('goods', $goods);
        $this->assign('received_url', '/goods/apply/received');
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("goods/apply_index_list");
        }else{
            $this->setView("goods/apply_index");
        }

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {
        $goods = $this->service->loadGoods();
        $this->assign('goods', $goods);
        $this->setOpt($this->actionTitle);
        $this->setView('goods/apply_add');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        $service = Loader::service(GoodsService::class);
        $goodsData = $service->fields('goods')->findById($data['goods_id']);
        $data['goods'] = $goodsData['goods'];
        $data['staff_id'] = $this->loginUser->getId();
        $data['name'] = $this->loginUser->getName();
        parent::_insert($data);
    }

    /**
     * 取消 操作
     * @param HttpRequest $request
     */
    public function cancel(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');
        if (empty($id)) {
            JsonResult::fail(Lang::OPT_FAIL);
        }
        if ($this->service->set('status', self::CANCEL, $id)) {
            JsonResult::success(Lang::OPT_SUCCESS);
        } else {
            JsonResult::fail(Lang::OPT_FAIL);
        }
    }

}