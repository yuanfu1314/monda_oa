<?php
/**
 * 管理员用户实体模型
 * ------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */

namespace app\admin\model;

class Admin
{

    protected $id; //ID
    protected $username; //用户名
    protected $name; //姓名
    protected $roleIds; //角色ID集合
    protected $password; //密码
    protected $salt; //密码盐
    protected $addTime; //添加时间
    protected $updateTime; //更新时间
    protected $enable; //启用状态， 0：禁用，1：启用
    protected $lastLoginIp; //最后登录 IP
    protected $lastLoginTime; //最后登录时间
    protected $permissions; //用户权限
    protected $isAdmin; //是否超级管理人员

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRoleIds()
    {
        return $this->roleIds;
    }

    /**
     * @param mixed $roleIds
     */
    public function setRoleIds($roleIds)
    {
        $this->roleIds = $roleIds;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * @param mixed $addTime
     */
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param mixed $updateTime
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param mixed $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return mixed
     */
    public function getLastLoginIp()
    {
        return $this->lastLoginIp;
    }

    /**
     * @param mixed $lastLoginIp
     */
    public function setLastLoginIp($lastLoginIp)
    {
        $this->lastLoginIp = $lastLoginIp;
    }

    /**
     * @return mixed
     */
    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
    }

    /**
     * @param mixed $lastLoginTime
     */
    public function setLastLoginTime($lastLoginTime)
    {
        $this->lastLoginTime = $lastLoginTime;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * 判断某个操作是否有权限
     * @param $opt
     * @return bool
     */
    public function hasPermission($opt) {
        return isset($this->permissions[$opt]);
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getLeaderId()
    {
        return $this->leader_id;
    }

    /**
     * @param mixed $leader_id
     */
    public function setLeaderId($leader_id)
    {
        $this->leader_id = $leader_id;
    }

    /**
     * @return mixed
     */
    public function getLeaderName()
    {
        return $this->leader_name;
    }

    /**
     * @param mixed $leader_name
     */
    public function setLeaderName($leader_name)
    {
        $this->leader_name = $leader_name;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

}