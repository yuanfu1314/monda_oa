<?php
namespace app\admin\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\admin\service\AnnouncementService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 公告控制器
 * @author  yuanfu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class AnnouncementAction extends CommonAction {

    protected $serviceClass = AnnouncementService::class;

    protected $actionTitle = "公告";

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
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("announcement/announcement_index_list");
        }else{
            $this->setView("announcement/announcement_index");
        }

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'添加');
        $this->setView('announcement/announcement_add');
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $this->setView('announcement/announcement_edit');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        $data['staff_id'] = $this->loginUser->getId();
        $data['name'] = $this->loginUser->getName();
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data','trim');
        $data['staff_id'] = $this->loginUser->getId();
        $data['name'] = $this->loginUser->getName();
        $id = $request->getParameter('id', 'intval');
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
        if ( $this->service->delete($id) ) {
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    }

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function getAnnouncement(HttpRequest $request) {
        $data = $this->service->fields('content')->where('enable', '1')->find();
        JsonResult::success(JsonResult::CODE_SUCCESS, $data);
    }
}