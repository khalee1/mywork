<?php

use Kd\Core\Controller\Controller as Controller;
use Kd\Core\Verify\Verify_Data as Verify;
use Kd\Models\Entities\Works as Works;
use Kd\Models\BLL\Work_BLL as Work_BLL;
use Kd\Models\BLL\Status_BLL as Status_BLL;
use Kd\Core\Verify\PostException as PostEx;

class Works_Controller extends Controller
{

    private $workBllModel = null;

    private $statusBllModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->workBllModel = new Work_BLL();
        $this->statusBllModel = new Status_BLL();
    }

    /**
     * Render works index page
     *
     * @param  null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function index()
    {
        $this->view->renderView('Layouts/header');
        $this->view->renderView('works/index');
        $this->view->renderView('Layouts/footer');
    }

    /**
     * Load data for works index page
     *
     * @param  null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function loadData()
    {
        echo $this->workBllModel->getAllWork();
    }

    /**
     * Add work page
     *
     * @param  null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function addWork()
    {
        try {
            $listKey = array('submit_add_work', 'work_name', 'start_date', 'end_date', 'id_status');

            Verify::checkPostHaveKey($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $workObject = new Works('', $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workBllModel->addWork($workObject))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');

        } catch (PostEx $exception) {
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->statusBllModel->getAllStatus();
        $this->view->renderView('Layouts/header');
        $this->view->renderView('works/add', $data);
        $this->view->renderView('Layouts/footer');
    }

    /**
     * Update Work by resize or drop event in calendar
     *
     * @param  null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function ajaxUpdate()
    {
        try {
            $listKey = array('id', 'start', 'end');

            Verify::checkPostHaveKey($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start'], $_POST['end']);

            $workObject = new Works($_POST['id'], '', $_POST['start'], $_POST['end'], '');

            if (!$this->workBllModel->updateWorkByResize($workObject))
                throw new Exception("Update Resize Fail");

            $this->view->to('works/index');

        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }
    }

    /**
     * Edit work page
     *
     * @param int $workId
     *
     * @return void
     *
     * @throws Exception
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function editWork($workId)
    {
        $work = null;
        $data = [];

        Verify::checkNotNull($workId);
        Verify::checkIsNumberGreaterThanZero($workId);

        $work = $this->workBllModel->getWork($workId);
        Verify::checkNotNull($work);

        $data['work'] = $work;

        try {
            $listKey = array('submit_edit_work', 'work_name', 'start_date', 'end_date', 'id_status');

            Verify::checkPostHaveKey($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $workObject = new Works($workId, $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workBllModel->updateWorkByEdit($workObject))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');
        } catch (PostEx $exception) {
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->statusBllModel->getAllStatus();
        $this->view->renderView('Layouts/header');
        $this->view->renderView('works/edit', $data);
        $this->view->renderView('Layouts/footer');
    }

    /**
     * Delete work
     *
     * @param int $workId
     *
     * @return void
     *
     * @throws Exception
     *
     * @author khaln@tech.est-rouge.com
     */
    public function deleteWork($workId)
    {
        Verify::checkNotNull($workId);
        Verify::checkIsNumberGreaterThanZero($workId);
        Verify::checkNotNull($this->workBllModel->getWork($workId));

        if (!$this->workBllModel->deleteWork($workId))
            throw new Exception("Delete Fail");

        $this->view->to('works/index?msg=del');
    }
}
