<?php
namespace app\leave\service;
use app\leave\dao\LeaveApplyDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;
use app\leave\service\LeaveService;

/**
 * 假期服务
 * ----------------
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class LeaveApplyService extends CommonService {

    protected $modelClassName = LeaveApplyDao::class;

    /**
     * 查询数据
     * @param json $search_data
     */
    public function search_data($search_data = [] ) {
        if (!empty($search_data)) {
            //转为数组
            $search = json_decode($search_data);

            if (isset($search->status) && $search->status != '') {
                $this->modelDao->where('status', $search->status);
            }
            if (!empty($search->name)) {
                $this->modelDao->where('name', 'LIKE', "%{$search->name}%");
            }
        }
    }

    /**
     * 加载假期类型
     * @return $items array 假期类型数组
     */
    public function loadLeaveType() {
        $service = Loader::service(LeaveService::class);
        $items = $service->fields('id, leave_type')->find();
        return $items;
    }

}