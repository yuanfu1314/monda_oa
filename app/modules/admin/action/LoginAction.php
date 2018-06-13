<?php
namespace app\admin\action;

use app\admin\service\AdminService;
use app\common\utils\Lang;
use herosphp\core\Controller;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use herosphp\utils\JsonResult;

/**
 * 用户登录
 * @author  YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class LoginAction extends Controller {

    /**
     * 首页方法
     * @param HttpRequest $request
     */
    public function index( HttpRequest $request ) {

        $this->setView("admin/login");

    }

    /**
     * 登入
     * @param HttpRequest $request
     */
    public function signin(HttpRequest $request) {

        $username = $request->getParameter('username', 'trim');
        $password = $request->getParameter('password', 'trim');

        $service = Loader::service(AdminService::class);
        $login = $service->login($username, $password);
        if ($login) {
            if ($login['enable'] == 0) {
                JsonResult::fail(Lang::USER_FORBID);
            }
            $service->updateLoginInfo($login['id']);
            JsonResult::success(Lang::LOGIN_SUCCESS);

        } else {
            JsonResult::fail(Lang::LOGIN_FAIL);
        }

    }

    /**
     * 登出
     * @param HttpRequest $request
     */
    public function logout(HttpRequest $request) {

        $service = Loader::service(AdminService::class);
        $service->logout();
        location("/admin/login/index");
    }
  
}