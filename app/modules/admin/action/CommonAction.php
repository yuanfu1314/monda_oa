<?php
namespace app\admin\action;

use app\admin\model\Admin;
use app\admin\service\AdminMenuService;
use app\admin\service\AdminService;
use app\common\utils\Lang;
use herosphp\core\Controller;
use herosphp\core\Loader;
use herosphp\core\WebApplication;
use herosphp\http\HttpRequest;
use herosphp\model\CommonService;
use herosphp\utils\JsonResult;
use herosphp\utils\ModelTransformUtils;
use herosphp\utils\Page;

/**
 * admin 模块基类控制
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
abstract class CommonAction extends Controller {

    // 页码
    protected $page = 1;

    // 每页数量
    protected $pageSize = 15;

    //排序方式
    protected $order = "id DESC";

    /**
     * 当前登陆的管理员
     * @var Admin
     */
    protected $loginUser;

    // 当前服务的 class path
    protected $serviceClass;

    /**
     * 当前服务
     * @var CommonService
     */
    protected $service;

    // 操作名称
    protected $actionTitle;

    public function __construct()
    {
        parent::__construct();
        $request = WebApplication::getInstance()->getHttpRequest();

        //获取当前登陆管理员
        $adminService = Loader::service(AdminService::class);
        $loginUser = $adminService->getLoginManager();
        if (!$loginUser) {
            location("/admin/login/index");
        }

        $this->loginUser = ModelTransformUtils::map2Model(Admin::class, $loginUser);
        $isAdmin = $this->loginUser->getIsAdmin();
        $this->assign('isAdmin', $isAdmin);
        $this->assign('loginUser', $this->loginUser);
        $permissions = array_keys($this->loginUser->getPermissions());
        $this->assign('permissions', $permissions);

        if ($this->serviceClass != null) {
            $this->service = Loader::service($this->serviceClass);
        }

        $module = $request->getModule();
        $action = $request->getAction();
        $this->assign("index_url", "/{$module}/{$action}/index");
        $this->assign('add_url', "/{$module}/{$action}/add");
        $this->assign('edit_url', "/{$module}/{$action}/edit");
        $this->assign("insert_url", "/{$module}/{$action}/insert");
        $this->assign("update_url", "/{$module}/{$action}/update");
        $this->assign('delete_url', "/{$module}/{$action}/delete");
        $this->assign('deletes_url', "/{$module}/{$action}/deletes");
        $this->assign('cancel_url', "/{$module}/{$action}/cancel");
        $this->assign('agree_url', "/{$module}/{$action}/agree");
        $this->assign('reject_url', "/{$module}/{$action}/reject");
        $this->assign("noRecords", Lang::NO_RECOEDS);

        //加载菜单
        $this->loadLeftMenu();
    }

    /**
     * @param HttpRequest $request
     * 首页列表
     */
    public function index(HttpRequest $request) {
        $this->page = $request->getParameter('page', 'intval');
        if ( $this->page <= 0 ) {
            $this->page = 1;
        }
        if (empty($this->service)) {
            $this->service = Loader::service($this->serviceClass);
        }

        $sqlBuilder = $this->service->getSqlBuilder();
        $items = $this->service->page($this->getPage(), $this->getPagesize())->order($this->getOrder())->find();
        $this->service->getModelDao()->setSqlBuilder($sqlBuilder);
        $total = $this->service->setSqlBuilder($sqlBuilder)->count();
        $this->PageView($total);
        $this->assign('items', $items);
    }

    /**
     * 分页
     * @param $total
     */
    protected function PageView($total){

        //初始化分页类
        $pageHandler = new Page($total, $this->getPagesize(), $this->getPage(), 3);
        //获取分页数据
        $pageData = $pageHandler->getPageData(DEFAULT_PAGE_STYLE);
        //组合分页HTML代码
        if ( $pageData ) {
            $pageMenu = '<ul class="am-pagination tpl-pagination">';
            $pageMenu .= '<li><a href="'.$pageData['first'].'">首页</a></li>';
            $pageMenu .= '<li><a href="'.$pageData['prev'].'">上一页</a></li> ';
            foreach ( $pageData['list'] as $key => $value ) {
                if ( $key == $this->page ) {
                    $pageMenu .= '<li class="am-active"><a href="#">'.$key.'</a></li> ';
                } else {
                    $pageMenu .= '<li><a href="'.$value.'">'.$key.'</a></li> ';
                }
            }
            $pageMenu .= '<li><a href="'.$pageData['next'].'">下一页</a></li> ';
            $pageMenu .= '<li><a href="'.$pageData['last'].'">末页</a></li>';
            $pageMenu .= '<li class="am-disabled page-count">总共'.ceil($pageData['total']/$this->pageSize).'页</li>';
            $pageMenu .= '</ul>';
        }
        $this->assign('pageMenu', $pageMenu);
    }

    /**
     * @param HttpRequest $request
     * 编辑数据
     */
    protected function _edit(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');
        if (empty($id)) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        } else {
            $item = $this->service->findById($id);
            $this->assign('item', $item);
        }
    }

    /**
     * 添加数据
     * @param $data
     * @param $callback
     */
    protected function _insert($data, $callback = null) {

        $data['addtime'] = date("Y-m-d H:i:s");
        $data['updatetime'] = date("Y-m-d H:i:s");
        if ($this->service->add($data)) {
            if (!is_null($callback)) {
                call_user_func($callback, $this->service);
            }
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::INSERT_SUCCESS);
        } else {
            $message = WebApplication::getInstance()->getAppError()->getMessage();
            JsonResult::result(JsonResult::CODE_FAIL, empty($message) ? Lang::INSERT_FAIL : $message);
        }
    }

    /**
     * 更新数据
     * @param array $data
     * @param $id
     * @param $callback
     */
    protected function _update(array $data, $id, $callback = null) {
        if (empty($id)) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        }
        $data['updatetime'] = date('Y-m-d H:i:s');
        if ($this->service->update($data, $id)) {
            if (!is_null($callback)) {
                call_user_func($callback, $this->service);
            }
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::UPDATE_SUCCESS);
        } else {
            $message = WebApplication::getInstance()->getAppError()->getMessage();
            JsonResult::result(JsonResult::CODE_FAIL, empty($message) ? Lang::UPDATE_FAIL : $message);
        }
    }

    /**
     * 启用|禁用 操作
     * @param HttpRequest $request
     * @param function $callback
     */
    public function enable(HttpRequest $request, $callback = null) {
        $id = $request->getParameter('id', 'trim');
        $enable = $request->getParameter('enable');
        $field = $request->getParameter('field');
        if (empty($id)) {
            JsonResult::fail(Lang::OPT_FAIL);
        }
        if ($this->service->set($field, $enable, $id)) {

            if (!is_null($callback)) {
                call_user_func($callback, $this->service);
            }

            JsonResult::success(Lang::OPT_SUCCESS);
        } else {
            JsonResult::fail(Lang::OPT_FAIL);
        }
    }

    /**
     * 设置操作名称
     * @param $name
     */
    protected function setOpt($name){
        $this->assign('optTitle', $name);
    }

    /**
     * 删除单条数据
     * @param HttpRequest $request
     * @param function $callback
     */
    public function delete(HttpRequest $request, $callback = null) {

        $id = $request->getParameter('id', 'trim');
        if ( empty($id) ) {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        }
        if ( $this->service->delete($id) ) {

            if (!is_null($callback)) {
                call_user_func($callback, $this->service);
            }

            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    }

    /**
     * 加载左侧的菜单
     * 设置最大的菜单200条
     */
    protected function loadLeftMenu() {
        $service = Loader::service(AdminMenuService::class);
        $items = $service->getMenuCache();
        $this->assign('adminMenus', $items);
    }

    /**
     * 删除多条数据
     * @param HttpRequest $request
     */
    public function deletes( HttpRequest $request ) {
        $ids = $request->getParameter('ids');
        if (empty($ids)){
            JsonResult::result(JsonResult::CODE_FAIL, Lang::NO_RECOEDS);
        }
        if ($this->service->deletes($ids)) {
            JsonResult::result(JsonResult::CODE_SUCCESS, Lang::DELETE_SUCCESS);
        } else {
            JsonResult::result(JsonResult::CODE_FAIL, Lang::DELETE_FAIL);
        }
    } 

    /**
     * @param HttpRequest $request
     */
    public function exists(HttpRequest $request) {

        $field = $request->getParameter('field', 'trim');
        $value = $request->getParameter('value', 'trim');
        if ($this->checkExist($field, $value)) {
            JsonResult::fail();
        } else {
            JsonResult::success();
        }
    }

    /**
     * @param $field  需要检查的字段
     * @param $value  需要检查的值
     * @param $field  where 条件的字段
     * @param $opt1   where 条件的字段操作符
     * @param $value1 where 条件字段的值
     * @return bool  true/false
     * 检验某个字段的值是否在数据库中存在，用于保持某个字段的唯一性
     */
    public function checkExist($field, $value, $field1 = '1', $opt1 = '=', $value1 = '1') {
        $value = trim($value);
        $exists = $this->service->where($field, $value)->where($field1, $opt1, $value1)->findOne();
        if ( $exists ) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getActionTitle()
    {
        return $this->actionTitle;
    }

    /**
     * @param mixed $actionTitle
     */
    public function setActionTitle($actionTitle)
    {
        $this->actionTitle = $actionTitle;
    }


}
