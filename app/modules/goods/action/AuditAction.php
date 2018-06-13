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
 * 物品审核控制器
 * @author  yuanfu<yuanf@pvc123.com>
 * @date 2018-06-03
 */
class AuditAction extends CommonAction {

    protected $serviceClass = GoodsApplyService::class;

    protected $actionTitle = "物品审核";

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
    const ACTION = 'audit';
    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        $search_data = $request->getParameter('search_data');
        $is_ajax = $request->getParameter('is_ajax');
        //数据查询
        $this->service->search_data($search_data);
        parent::index($request);

        $items = $this->getTemplateVar('items');

        foreach ($items as $key => $item) {
            $items[$key]['status'] = isset($this->goods_status_remark[$item['status']])? $this->goods_status_remark[$item['status']] : '';
            $items[$key]['is_show'] = $this->showButton($item['status']);
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $goods = $this->service->loadGoods();
        $this->assign('goods', $goods);
        $this->assign('received_url', '/goods/apply/received');
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("goods/audit_index_list");
        }else{
            $this->setView("goods/audit_index");
        }

    }

    /**
     * 拒绝申请 操作
     * @param HttpRequest $request
     */
    public function reject(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');
        $this->setOpt($this->actionTitle.'拒绝');
        parent::_edit($request);
        $this->assign('status', self::REJECT);
        $this->assign('update_url', '/goods/apply/rejectUpdate');
        $this->setView('goods/audit_edit');
    }

    /**
     * 确认领取 操作
     * @param HttpRequest $request
     */
    public function received(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');

        if (empty($id)) {
            JsonResult::fail(Lang::OPT_FAIL);
        }
        if ($this->service->set('status', self::RECEIVED, $id)) {
            JsonResult::success(Lang::OPT_SUCCESS);
        } else {
            JsonResult::fail(Lang::OPT_FAIL);
        }
    }

    /**
     * 更新审核数据
     * @param HttpRequest $request
     */
    public function rejectUpdate(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        $id = $request->getParameter('id', 'intval');
        $data['status'] = $request->getParameter('status', 'intval');
        $data['auditor_id'] = $this->loginUser->getId();
        $data['auditor'] = $this->loginUser->getName();
        parent::_update($data, $id);
    }

    /**
     * 是否显示拒绝按钮
     * @param $status string 申请状态
     * @return true/false 
     */
    public function showButton($status) {
        return $status == self::APPLY ? true : false;
    }

}