<?php

use Kd\Core\Controller\Controller as Controller;
use Kd\Core\Verify\ValidateDataForm as Verify;
use Kd\Models\DTO\Works as Works;
use Kd\Models\BLO\Work_BLO as Work_BLO;
use Kd\Models\BLO\Status_BLO as Status_BLO;
use Kd\Core\Verify\PostException as PostEx;

class Works_Controller extends Controller
{

    private $workBloModel = null;

    private $statusBloModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->workBloModel = new Work_BLO();
        $this->statusBloModel = new Status_BLO();
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
        echo $this->workBloModel->getAllWork();
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

            if (!$this->workBloModel->addWork($workObject))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');

        } catch (PostEx $exception) {
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->statusBloModel->getAllStatus();
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

            if (!$this->workBloModel->updateWorkByResize($workObject))
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

        $work = $this->workBloModel->getWork($workId);
        Verify::checkNotNull($work);

        $data['work'] = $work;

        try {
            $listKey = array('submit_edit_work', 'work_name', 'start_date', 'end_date', 'id_status');

            Verify::checkPostHaveKey($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $workObject = new Works($workId, $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workBloModel->updateWorkByEdit($workObject))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');
        } catch (PostEx $exception) {
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->statusBloModel->getAllStatus();
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
        Verify::checkNotNull($this->workBloModel->getWork($workId));

        if (!$this->workBloModel->deleteWork($workId))
            throw new Exception("Delete Fail");

        $this->view->to('works/index?msg=del');
    }
}
