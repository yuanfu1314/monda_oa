<?php
namespace app\admin\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\core\WebApplication;
use herosphp\http\HttpRequest;
use app\admin\service\AdminPermissionService;
use herosphp\utils\JsonResult;

/**
 * 管理员权限控制器
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class PermissionAction extends CommonAction {

    protected $serviceClass = AdminPermissionService::class;

    protected $actionTitle = "管理员权限";

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
        $appConfigs = WebApplication::getInstance()->getConfigs();
        $permissionsConfigs = $appConfigs['permission_group'];
        foreach($items as $key => $val) {
            $items[$key]['groupName'] = $permissionsConfigs[$val['pgroup']];
        }
        $this->assign('items', $items);
        $this->setOpt($this->actionTitle."列表");
        if ($is_ajax == true) {
            $this->setView("permission/permission_index_list");
        }else{
            $this->setView("permission/permission_index");
        }

    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        if (empty($item)) {
            JsonResult::fail(Lang::FETCH_FAIL);
        } else {
            $json = new JsonResult('0', '', array());
            $json->setCode(JsonResult::CODE_SUCCESS);
            $json->putItem($item);
            $json->output();
        }

    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data');
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data');
        $id = $request->getParameter('id', 'intval');
        parent::_update($data, $id);
    }
}