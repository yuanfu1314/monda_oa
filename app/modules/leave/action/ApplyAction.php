<?php
namespace app\leave\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\leave\service\LeaveApplyService;
use app\leave\service\LeaveService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 假期申请控制器
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
class ApplyAction extends CommonAction {

    protected $serviceClass = LeaveApplyService::class;

    protected $actionTitle = "假期申请";

    protected $leave_status_remark = array(
        '0' => '申请中',
        '1' => '同意申请',
        '2' => '拒绝申请',
        '3' => '取消申请'
    );
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
            $items[$key]['status'] = isset($this->leave_status_remark[$item['status']])? $this->leave_status_remark[$item['status']] : '';
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("leave/apply_index_list");
        }else{
            $this->setView("leave/apply_index");
        }

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {
        $leave_type = $this->service->loadLeaveType();
        $this->assign('leave_types', $leave_type);
        $this->setOpt($this->actionTitle);
        $this->setView('leave/apply_add');
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $this->setView('leave/leave_edit');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data', 'trim');
        $service = Loader::service(LeaveService::class);
        $leaveData = $service->fields('leave_type')->findById($data['leave_type_id']);
        $data['leave_type'] = $leaveData['leave_type'];
        $data['staff_id'] = $this->loginUser->getId();
        $data['name'] = $this->loginUser->getName();
        $data['leader_id'] = $this->loginUser->getLeaderId();
        $data['leader_name'] = $this->loginUser->getLeaderName();
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data', 'trim');
        $id = $request->getParameter('id', 'intval');
        //leave_type是否唯一
        $unique = parent::checkExist('leave_type', $data['leave_type'], 'id', '!=', $id);
        if ($unique == true) {
            JsonResult::fail(Lang::LEAVE_TYPE_FAIL);
        }
        parent::_update($data, $id);
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