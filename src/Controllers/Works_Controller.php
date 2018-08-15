<?php

use Kd\Core\Controller\Controller as Controller;
use Kd\Core\Verify\Verify_Data as Verify;
use Kd\Models\Entities\Works as Works;
use Kd\Models\DAO\Work_DAO as Work_DAO;

class Works_Controller extends Controller
{

    private $workModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->workModel = new Work_DAO($this->db);
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/works/index
     */
    public function index()
    {
        $this->view->renderView('Layouts/header');
        $this->view->renderView('works/index');
        $this->view->renderView('Layouts/footer');
    }

    /**
     * Action: load
     * This method handles what happens when you move to http://yourproject/works/load
     */
    public function loadData()
    {
        $result = $this->workModel->getAllWork();

        if (count($result) > 0) {
            $data = array();
            foreach ($result as $row) {
                $data[] = array(
                    'id' => $row->id,
                    'title' => $row->work_name,
                    'start' => $row->start_date,
                    'end' => $row->end_date,
                    'color' => $row->color
                );
            }

            echo json_encode($data);
        }
    }

    /**
     * PAGE: add
     * This method handles what happens when you move to http://yourproject/works/add
     */
    public function addWork()
    {
        try {
            $listKey = array('submit_add_work', 'work_name', 'start_date', 'end_date', 'id_status');

            Verify::checkPost($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $work = new Works('', $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workModel->addWork($work))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');

        } catch (Exception $exception) {
            var_dump($_POST);
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->workModel->getAllStatus();
        $this->view->renderView('Layouts/header');
        $this->view->renderView('works/add', $data);
        $this->view->renderView('Layouts/footer');
    }

    /**
     * Action: update
     * This method handles what happens when you move to http://yourproject/works/update
     */
    public function ajaxUpdate()
    {
        try {
            $listKey = array('id', 'start', 'end');

            Verify::checkPost($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start'], $_POST['end']);

            $work = new Works($_POST['id'], '', $_POST['start'], $_POST['end'], '');

            if (!$this->workModel->updateWorkByResize($work))
                throw new Exception("Update Resize Fail");

            $this->view->to('works/index');

        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }
    }

    /**
     * PAGE: edit
     * This method handles what happens when you move to http://yourproject/works/edit/id
     */
    public function editWork($workId)
    {
        $work = null;
        $data = [];
        try {
            Verify::checkNotNull($workId);

            $workId = (int)$workId;
            Verify::checkIsNumber($workId);

            $work = $this->workModel->getWork($workId);
            Verify::checkNotNull($work);

            $data['work'] = $work;
        } catch (Exception $exception) {
            $this->view->to('works/index');
        }

        try {
            $listKey = array('submit_edit_work', 'work_name', 'start_date', 'end_date', 'id_status');

            Verify::checkPost($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $workEdit = new Works($workId, $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workModel->updateWorkByEdit($workEdit))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->workModel->getAllStatus();
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
     * @author khaln@tech.est-rouge.com
     */
    public function deleteWork($workId)
    {
        try {
            Verify::checkNotNull($workId);
            Verify::checkIsNumber($workId);

            if (!$this->workModel->deleteWork($workId))
                throw new Exception("Delete Fail");

            $this->view->to('works/index?msg=del');
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }


    }
}
