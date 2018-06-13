<?php
namespace app\leave\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\leave\service\LeaveApplyService;
use app\leave\service\LeaveService;
use app\admin\service\AdminService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 假期申请控制器
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class AuditAction extends CommonAction {

    protected $serviceClass = LeaveApplyService::class;

    protected $actionTitle = "假期审核";

    protected $leave_status_remark = array(
        '0' => '申请中',
        '1' => '同意申请',
        '2' => '拒绝申请',
        '3' => '取消申请'
    );
    const APPLY = 0;
    const AGREE = 1;
    const REJECT = 2;
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
            $items[$key]['status'] = isset($this->leave_status_remark[$item['status']])? $this->leave_status_remark[$item['status']] : '';
            $items[$key]['is_show'] = $this->showButton($item['status']);
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $this->setOpt($this->actionTitle.'列表');
        $this->setView("leave/audit_index");
        if ($is_ajax == true) {
            $this->setView("leave/apply_index_list");
        }else{
            $this->setView("leave/audit_index");
        }

    }

    /**
     * 同意申请 操作
     * @param HttpRequest $request
     */
    public function agree(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');
        $this->setOpt($this->actionTitle.'同意');
        parent::_edit($request);
        $this->assign('status', self::AGREE);
        $this->setView('leave/audit_edit');
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
        $this->setView('leave/audit_edit');
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data', 'trim');
        $id = $request->getParameter('id', 'intval');
        $data['status'] = $request->getParameter('status', 'intval');
        $data['auditor_id'] = $this->loginUser->getId();
        $data['auditor'] = $this->loginUser->getName();
        parent::_update($data, $id);
    }

    /**
     * 是否显示审核/拒绝按钮
     * @param $status string 申请状态
     * @return true/false 
     */
    public function showButton($status) {
        return $status == self::APPLY ? true : false;
    }

}