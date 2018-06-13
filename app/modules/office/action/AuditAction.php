<?php
namespace app\office\action;

use app\leave\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\office\service\OfficeApplyService;
use app\office\service\OfficeService;
use app\admin\service\AdminService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 办公室申请控制器
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-03
 */
class AuditAction extends CommonAction {

    protected $serviceClass = OfficeApplyService::class;

    protected $actionTitle = "办公室审核";

    protected $office_status_remark = array(
        '0' => '已申请',
        '1' => '正在使用',
        '2' => '申请过期',
        '3' => '关闭申请',
        '4' => '拒绝申请'
    );
    const APPLY = 0;
    const USING = 1;
    const OVERDUE = 2;
    const CLOSE = 3;
    const REJECT = 4;
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
            $items[$key]['status'] = isset($this->office_status_remark[$item['status']])? $this->office_status_remark[$item['status']] : '';
            $items[$key]['is_show'] = $this->showButton($item['status']);
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $offices = $this->service->loadOffice();
        $this->assign('offices', $offices);
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("office/apply_index_list");
        }else{
            $this->setView("office/audit_index");
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
        $this->assign('update_url', '/office/apply/rejectUpdate');
        $this->setView('office/audit_edit');
    }

    /**
     * 更新审核数据
     * @param HttpRequest $request
     */
    public function rejectUpdate(HttpRequest $request) {
        $data = $request->getParameter('data', 'trim');
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
        return $status == self::REJECT ? true : false;
    }

}