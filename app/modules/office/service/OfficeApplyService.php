<?php
namespace app\office\service;
use app\office\dao\OfficeApplyDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;
use app\office\service\OfficeService;

/**
 * 办公室申请服务
 * ----------------
 * @author yuanfu<yuanf@pvc123.com>
 */
class OfficeApplyService extends CommonService {

    protected $modelClassName = OfficeApplyDao::class;

    /**
     * 查询数据
     * @param json $search_data
     */
    public function search_data($search_data = [] ) {
        if (!empty($search_data)) {
            //转为数组
            $search = json_decode($search_data);

            if (isset($search->office) && $search->office != '' ) {
                $this->modelDao->where('office_id', $search->office);
            }
            if (isset($search->status) && $search->status != '') {
                $this->modelDao->where('status', $search->status);
            }
            if (!empty($search->name)) {
                $this->modelDao->where('name', 'LIKE', "%{$search->name}%");
            }
            if (!empty($search->time_begin_start)) {
                $this->modelDao->where('time_begin', '>=', $search->time_begin_start);
            }
            if (!empty($search->time_begin_end)) {
                $this->modelDao->where('time_begin', '<=', $search->time_begin_end);
            }
            if (!empty($search->time_end_start)) {
                $this->modelDao->where('time_end', '>=', $search->time_end_start);
            }
            if (!empty($search->time_end_end)) {
                $this->modelDao->where('time_end', '<=', $search->time_end_end);
            }
        }
    }

    /**
     * 加载办公室
     * @return $items array 办公室数组
     */
    public function loadOffice() {
        $service = Loader::service(OfficeService::class);
        $items = $service->fields('id, office')->find();
        return $items;
    }

}