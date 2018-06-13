<?php
namespace app\office\action;

use app\common\utils\Lang;
use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\office\service\OfficeApplyService;
use app\office\service\OfficeService;
use herosphp\string\StringUtils;
use herosphp\utils\JsonResult;
use app\admin\action\CommonAction;

/**
 * 办公室申请控制器
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-13
 */
class ApplyAction extends CommonAction {

    protected $serviceClass = OfficeApplyService::class;

    protected $actionTitle = "办公室申请";

    protected $office_status_remark = array(
        '0' => '已申请',
        '1' => '正在使用',
        '2' => '申请过期',
        '3' => '关闭申请',
        '4' => '拒绝申请'
    );
    const APPLY = 0;
    const USING = 1;
    const OVERDUE = 2;
    const CLOSE = 3;
    const REJECT = 4;
    const ACTION = 'apply';

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        $search_data = $request->getParameter('search_data');
        $is_ajax = $request->getParameter('is_ajax');
        //数据查询
        $this->service->search_data($search_data);
        $this->service->where('staff_id', $this->loginUser->getId());
        parent::index($request);

        $items = $this->getTemplateVar('items');

        foreach ($items as $key => $item) {
            $items[$key]['status'] = isset($this->office_status_remark[$item['status']])? $this->office_status_remark[$item['status']] : '';
        }
        $this->assign('items', $items);
        $this->assign('action', self::ACTION);
        $offices = $this->service->loadOffice();
        $this->assign('offices', $offices);
        $this->setOpt($this->actionTitle.'列表');
        if ($is_ajax == true) {
            $this->setView("office/apply_index_list");
        }else{
            $this->setView("office/apply_index");
        }
        
    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {
        $offices = $this->service->loadOffice();
        $this->assign('offices', $offices);
        $this->setOpt($this->actionTitle);
        $this->setView('office/apply_add');
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $this->setView('office/office_edit');
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data', 'trim');
        if (strtotime($data['time_begin']) >= strtotime($data['time_end'])) {
            JsonResult::fail(Lang::DATETIME_OVER_FAIL);
        }
        $service = Loader::service(OfficeService::class);
        $officeData = $service->fields('office')->findById($data['office_id']);
        $data['office'] = $officeData['office'];
        $data['staff_id'] = $this->loginUser->getId();
        $data['name'] = $this->loginUser->getName();
        parent::_insert($data);
    }    

    /**
     * 取消 操作
     * @param HttpRequest $request
     */
    public function cancel(HttpRequest $request) {
        $id = $request->getParameter('id', 'trim');
        if (empty($id)) {
            JsonResult::fail(Lang::OPT_FAIL);
        }
        if ($this->service->set('status', self::CLOSE, $id)) {
            JsonResult::success(Lang::OPT_SUCCESS);
        } else {
            JsonResult::fail(Lang::OPT_FAIL);
        }
    }

}