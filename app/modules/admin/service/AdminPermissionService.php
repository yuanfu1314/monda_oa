<?php
namespace app\admin\service;
use app\admin\dao\AdminPermissionDao;
use herosphp\model\CommonService;

/**
 * 管理员角色权限服务
 * ----------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
class AdminPermissionService extends CommonService {

    protected $modelClassName = AdminPermissionDao::class;

    /**
     * 查询数据
     * @param json $search_data
     */
    public function search_data($search_data = [] ) {
        if (!empty($search_data)) {
            //转为数组
            $search = json_decode($search_data);

            if (isset($search->name) && $search->name != '' ) {
                $this->modelDao->where('name', 'LIKE', "%{$search->name}%");
            }
            if (isset($search->pkey) && $search->pkey != '') {
                $this->modelDao->where('pkey', 'LIKE', "%{$search->pkey}%");
            }
            if (!empty($search->pgroup)) {
                $this->modelDao->where('pgroup', $search->pgroup);
            }
        }
    }

}