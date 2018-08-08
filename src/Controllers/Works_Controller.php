<?php

use Kd\Core\Controller\Controller as Controller;

class Works_Controller extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/works/index
     */
    public function index()
    {
        require BASE_PATH . 'Views/Layouts/header.php';
        require BASE_PATH . 'Views/works/index.php';
        require BASE_PATH . 'Views/Layouts/footer.php';
    }
    /**
     * Action: load
     * This method handles what happens when you move to http://yourproject/works/load
     */
    public function load()
    {
        $result = $this->model->getAllWork();
        if (count($result)>0) {
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
    public function add()
    {
        if (isset($_POST["submit_add_work"])) {
            $d1 = new DateTime($_POST['start_date']);
            $d2 = new DateTime($_POST['end_date']);
            if ($d2 < $d1) {
                header('location: ' . URL . "works/add?msgd=er");
            }
            if ($this->model->addWork($_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status'])) {
                header('location: ' . URL . 'works/index');
            } else {
                header('location: ' . URL . 'works/add');
            }
        } else {
            $list_status = $this->model->getAllStatus();
            require BASE_PATH . 'Views/Layouts/header.php';
            require BASE_PATH . 'Views/works/add.php';
            require BASE_PATH . 'Views/Layouts/footer.php';
        }
    }
    /**
     * Action: update
     * This method handles what happens when you move to http://yourproject/works/update
     */
    public function update()
    {
          if(isset($_POST['id']))
            if ($this->model->updateWorkByResize( $_POST['start'] ,$_POST['end'] , $_POST['id'])) {
                header('location: ' . URL . "works/index");
            }
    }
    /**
     * PAGE: edit
     * This method handles what happens when you move to http://yourproject/works/edit
     */
    public function edit()
    {
        if (isset($_POST["submit_edit_work"])) {

            $d1 = new DateTime($_POST['start_date']);
            $d2 = new DateTime($_POST['end_date']);
            if ($d2 < $d1) {
                header('location: ' . URL . "works/edit?msgd=er");

            }
            $this->model->updateWork($_POST['work_name'], $_POST['start_date'], $_POST['end_date'], $_POST['id_status'] , $_POST['id_work']);
            header('location: ' . URL . 'works/index');

        } elseif (isset($_GET['id'])) {

            $work = $this->model->getWork($_GET['id']) ;
            if (empty($work))
                header('location: ' . URL . 'works/index');
            $list_status = $this->model->getAllStatus();
            require BASE_PATH . 'Views/Layouts/header.php';
            require BASE_PATH . 'Views/works/edit.php';
            require BASE_PATH . 'Views/Layouts/footer.php';

        }
    }


    /**
     * ACTION: delete Work
     * This method handles what happens when you move to http://yourproject/works/delete/id
     * @param int $work_id Id of the to-delete work
     */
    public function delete($work_id)
    {
        if (isset($work_id)) {

            $this->model->deleteWork($work_id);
        }
        header('location: ' . URL . 'works/index?msg=del');
    }

}
