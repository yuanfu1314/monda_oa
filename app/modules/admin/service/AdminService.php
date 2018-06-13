<?php
namespace app\admin\service;
use app\admin\dao\AdminDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;
use herosphp\web\WebUtils;

/**
 * 管理员服务
 * ----------------
 * @author yangjian<yangjian102621@gmail.com>
 */
class AdminService extends CommonService {

    protected $modelClassName = AdminDao::class;

    // 用户登录 session key
    const LOGIN_USER_SESSION_KEY = 'LOGIN_USER_SESSION_KEY';

    /**
     * 用户登录服务
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username, $password) {
        $item = $this->where('username', $username)->findOne();
        $_password = genPassword($password, $item['salt']);

        if ($_password != $item['password']) {
            return false;
        }

        //获取用户角色和权限
        $roleService = Loader::service(AdminRoleService::class);
        $roleIds = StringUtils::jsonDecode($item['role_ids']);
        $roles = $roleService->where('id', 'IN', $roleIds)->find();
        $permissions = [];
        foreach($roles as $value) {
            $permissions = array_merge($permissions, StringUtils::jsonDecode($value['permissions']));
        }
        $item['permissions'] = $permissions;
        Session::start();
        Session::set(self::LOGIN_USER_SESSION_KEY, $item);
        return $item;
    }

    /**
     * 获取当前登录的管理员
     */
    public function getLoginManager() {

        Session::start();
        return Session::get(self::LOGIN_USER_SESSION_KEY);
    }

    /**
     * 登出
     */
    public function logout() {
        Session::start();
        Session::set(self::LOGIN_USER_SESSION_KEY, null);
    }

    /**
     * 更新用户登录信息
     * @param $id  用户ID
     */
    public function updateLoginInfo($id) {
        //更新最后登陆ip和登录时间
        $lastLoginTime = date('Y-m-d H:i:s');
        $lastLoginIp = WebUtils::getClientIP();
        $data = array(
            'last_login_time' => $lastLoginTime,
            'last_login_ip' => $lastLoginIp
        );
        $this->modelDao->update($data, $id);
    }

}