<?php
namespace app\goods\service;
use app\goods\dao\GoodsApplyDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;
use app\goods\service\GoodsService;

/**
 * 物品申请服务
 * ----------------
 * @author yuanfu<yuanf@pvc123.com>
 */
class GoodsApplyService extends CommonService {

    protected $modelClassName = GoodsApplyDao::class;

    /**
     * 查询数据
     * @param json $search_data
     */
    public function search_data($search_data = [] ) {
        if (!empty($search_data)) {
            //转为数组
            $search = json_decode($search_data);

            if (isset($search->goods) && $search->goods != '' ) {
                $this->modelDao->where('goods_id', $search->goods);
            }
            if (isset($search->status) && $search->status != '') {
                $this->modelDao->where('status', $search->status);
            }
            if (!empty($search->name)) {
                $this->modelDao->where('name', 'LIKE', "{$search->name}%");
            }
            if (!empty($search->time_begin)) {
                $this->modelDao->where('addtime', '>=', $search->time_begin);
            }
            if (!empty($search->time_end)) {
                $this->modelDao->where('addtime', '<=', $search->time_end);
            }
        }
    }
    /**
     * 加载物品数据
     * @return $items array 物品数组
     */
    public function loadGoods() {
        $service = Loader::service(GoodsService::class);
        $items = $service->fields('id, goods')->find();
        return $items;
    }

}