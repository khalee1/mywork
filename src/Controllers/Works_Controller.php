<?php

use Kd\Core\Controller\Controller as Controller;
use Kd\Core\Verify\Verify_Data as Verify;
use Kd\Models\Entities\Works as Works;
use Kd\Models\DAO\Work_DAO as Work_DAO;
use Kd\Core\Verify\PostException as PostEx;

class Works_Controller extends Controller
{

    private $workModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->workModel = new Work_DAO($this->db);
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

            Verify::checkPost($listKey, $_POST);
            Verify::checkIsDateStartLessThanDateEnd($_POST['start_date'], $_POST['end_date']);

            $work = new Works('', $_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status']);

            if (!$this->workModel->addWork($work))
                throw new \Exception("Add Work Fail");

            $this->view->to('works/index');

        } catch (PostEx $exception) {
        } catch (Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        $data['listStatus'] = $this->workModel->getAllStatus();
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
     * Edit work page
     *
     * @param int $workId
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function editWork($workId)
    {
        $work = null;
        $data = [];
        try {
            Verify::checkNotNull($workId);
            Verify::checkIsNumberGreaterThanZero($workId);

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
        } catch (PostEx $exception) {
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
            Verify::checkIsNumberGreaterThanZero($workId);
            Verify::checkNotNull($this->workModel->getWork($workId));

            $this->workModel->deleteWork($workId);

            $this->view->to('works/index?msg=del');
        } catch (Exception $exception) {
            $this->view->to('works/index?msg=err');
        }


    }
}
