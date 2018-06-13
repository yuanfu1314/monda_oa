<?php
namespace app\admin\service;
use app\admin\dao\AnnouncementDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;

/**
 * 公告服务
 * ----------------
 * @author yuanfu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class AnnouncementService extends CommonService {

    protected $modelClassName = AnnouncementDao::class;

    /**
     * 查询数据
     * @param json $search_data
     */
    public function search_data($search_data = [] ) {
        if (!empty($search_data)) {
            //转为数组
            $search = json_decode($search_data);

            if (isset($search->enable) && $search->enable != '') {
                $this->modelDao->where('enable', $search->enable);
            }
            if (!empty($search->name)) {
                $this->modelDao->where('name', 'LIKE', "%{$search->name}%");
            }
            if (!empty($search->time_begin)) {
                $this->modelDao->where('addtime', '>=', $search->time_begin);
            }
            if (!empty($search->time_end)) {
                $this->modelDao->where('addtime', '<=', $search->time_end);
            }
        }
    }

}