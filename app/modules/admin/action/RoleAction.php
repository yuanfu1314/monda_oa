<?php
namespace app\admin\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\core\WebApplication;
use herosphp\http\HttpRequest;
use app\admin\service\AdminRoleService;
use app\admin\service\AdminPermissionService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;

/**
 * 管理员角色控制器
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class RoleAction extends CommonAction {

    protected $serviceClass = AdminRoleService::class;

    protected $actionTitle = "管理员角色";

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {
        parent::index($request);
        $this->assign("auth_url", "/admin/role/savePermissions");
        $auth_url = $this->getTemplateVar('auth_url');
        $this->setOpt($this->actionTitle."列表");
        $this->setView("role/role_index");

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
        $data['role_ids'] = $request->getParameter('rids');
        //角色名称是否唯一
        $unique = parent::checkExist('name', $data['name']);
        if ($unique == true) {
            JsonResult::fail(Lang::ROLE_NAME_EXIST);
        }
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data');
        $id = $request->getParameter('id', 'intval');
        //角色名称是否唯一
        $unique = parent::checkExist('name', $data['name'], 'id', '!=', $id);
        if ($unique == true) {
            JsonResult::fail(Lang::ROLE_NAME_EXIST);
        }
        parent::_update($data, $id);
    }

    /**
     * 获取权限列表
     * @param HttpRequest $request
     */
    public function getPermissions(HttpRequest $request) {

        $id = $request->getParameter('id', 'intval');
        $permissionService = Loader::service(AdminPermissionService::class);
        $permissions = $permissionService->page(0, 200)->find();
        $permissions = arrayGroup($permissions, 'pgroup');
        if (empty($permissions)) {
            JsonResult::fail(Lang::GET_PERMISSION_FAIL);
        } else {
            //整理权限数组
            $appConfigs = WebApplication::getInstance()->getConfigs();
            $permissionConfigs = $appConfigs['permission_group'];
            $items = [];
            foreach($permissions as $key => $value) {
                $items[$key]['groupName'] = $permissionConfigs[$key];
                $items[$key]['permissionList'] = $value;
            }
            // 获取当前角色的初始化权限
            $role = $this->service->findById($id);
            $p = StringUtils::jsonDecode($role['permissions']);
            $json = new JsonResult('0', '', array());
            $json->setCode(JsonResult::CODE_SUCCESS);
            $json->putItems($items);
            $json->putItem($p);
            $json->output();
        }
    }

    /**
     * 保存权限
     * @param HttpRequest $request
     */
    public function savePermissions(HttpRequest $request) {

        $roleId = $request->getParameter('roleId', 'intval');
        $permissions = $request->getParameter('permissions');
        if ($this->service->set('permissions', StringUtils::jsonEncode($permissions), $roleId)) {
            JsonResult::success(Lang::SAVE_PERMISSION_SUCCESS);
        } else {
            JsonResult::fail(Lang::SAVE_PERMISSION_FAIL);
        }
    }
}