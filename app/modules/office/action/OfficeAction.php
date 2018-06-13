<?php
namespace app\office\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\office\service\OfficeService;
use app\office\service\OfficeApplyService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 办公室控制器
 * @author  yuanfu<yuanf@pvc123.com>
 */
class OfficeAction extends CommonAction {

    protected $serviceClass = OfficeService::class;

    protected $actionTitle = "办公室";

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        parent::index($request);
        $this->setOpt($this->actionTitle.'列表');
        $this->setView("office/office_index");

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'添加');
        $this->setView('office/office_add');
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $this->setView('office/office_edit');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        //office是否唯一
        $unique = parent::checkExist('office', $data['office']);
        if ($unique == true) {
            JsonResult::fail(Lang::OFFICE_FAIL);
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
        //office是否唯一
        $unique = parent::checkExist('office', $data['office'], 'id', '!=', $id);
        if ($unique == true) {
            JsonResult::fail(Lang::OFFICE_FAIL);
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
        $service = Loader::service(OfficeApplyService::class);
        $item = $service->fields('id')->where('office_id',$id)->findOne();
        if (!empty($item['id'])) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_OFFICE_FAIL);
        }
        if ( $this->service->delete($id) ) {
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    }
}