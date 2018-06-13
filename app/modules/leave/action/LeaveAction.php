<?php
namespace app\leave\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\leave\service\LeaveService;
use app\leave\service\LeaveApplyService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 假期控制器
 * @author  yuanfu<yuanf@pvc123.com>
 */
class LeaveAction extends CommonAction {

    protected $serviceClass = LeaveService::class;

    protected $actionTitle = "假期类型";

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {
        parent::index($request);
        $this->setOpt($this->actionTitle.'列表');
        $this->setView("leave/leave_index");
    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {
        $this->setOpt($this->actionTitle.'添加');
        $this->setView('leave/leave_add');
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
        $data = $request->getParameter('data','trim');
        //leave_type是否唯一
        $unique = parent::checkExist('leave_type', $data['leave_type']);
        if ($unique == true) {
            JsonResult::fail(Lang::LEAVE_TYPE_FAIL);
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
        //leave_type是否唯一
        $unique = parent::checkExist('leave_type', $data['leave_type'], 'id', '!=', $id);
        if ($unique == true) {
            JsonResult::fail(Lang::LEAVE_TYPE_FAIL);
        }
        parent::_update($data, $id);
    }

    /**
     * 删除单条数据
     * @param HttpRequest $request
     */
    public function delete(HttpRequest $request, $callback = null) {

        $id = $request->getParameter('id', 'trim');
        if ( empty($id) ) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        }
        $service = Loader::service(LeaveApplyService::class);
        $item = $service->fields('id')->where('leave_type_id',$id)->findOne();
        if (!empty($item['id'])) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_EXISTS_FAIL);
        }
        if ( $this->service->delete($id) ) {
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    }

}