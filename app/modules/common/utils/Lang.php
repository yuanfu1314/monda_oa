<?php
namespace app\common\utils;
/**
 * 后台模块语言包
 * User: yangjian
 * Date: 17-10-10
 * Time: 下午3:53
 */
class Lang
{

    const SYS_ERROR = "系统开了小差";
    const OPT_SUCCESS = '操作成功';
    const OPT_FAIL = '操作失败';
    const NO_RECOEDS = "暂无记录.";
    const FETCH_FAIL = '获取数据失败';
    const INSERT_SUCCESS = "添加数据成功";
    const INSERT_FAIL = "添加数据失败";
    const UPDATE_SUCCESS = "更新成功";
    const UPDATE_FAIL = "更新失败";
    const DELETE_SUCCESS = "删除成功";
    const DELETE_FAIL = "删除失败";
    const LEAVE_TYPE_FAIL = '假期类型已存在';
    const DELETE_EXISTS_FAIL = '该假期类型已经有申请记录，不能删除';
    const OFFICE_FAIL = '办公室已存在';
    const DELETE_OFFICE_FAIL = '该办公室已经有申请记录，不能删除';
    const DATETIME_OVER_FAIL = '开始使用时间必须小于结束使用时间';
    const GOODS_FAIL = '该物品已存在';
    const DELETE_GOODS_FAIL = '该物品已经有申请记录，不能删除';
    const GET_PERMISSION_FAIL = "获取权限失败";
    const SAVE_PERMISSION_SUCCESS = '更新权限成功';
    const SAVE_PERMISSION_FAIL = '更新权限失败';
    const USER_FORBID = '您的账户被禁用，请联系管理员';
    const LOGIN_FAIL = '登录失败，用户名或者密码错误';
    const LOGIN_SUCCESS = '登录成功';
    const MD_PASS_SUCCESS = '密码修改成功，请重新登录';
    const MD_PASS_FAIL = '密码修改失败';
    const OLD_PASS_ERROR = '原始密码错误';
    const ROLE_NAME_EXIST = '角色名称已经存在';

}