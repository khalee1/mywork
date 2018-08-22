<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/16/18
 * Time: 9:15 AM
 */

namespace Kd\Models\BLO;

use Kd\Models\DAO\Work_DAO;
use Kd\Models\DTO\Works;

class Work_BLO
{
    public $workDAO = null;

    function __construct()
    {
        $this->workDAO = new Work_DAO();
    }

    /**
     * Get all works and convert to json
     *
     * @param null
     *
     * @return json data
     *
     * @author  khaln@tech.est-rouge.com
     */
    public function getAllWork()
    {
        $result = $this->workDAO->getAllWork();

        if (count($result) <= 0) return null;

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

        return json_encode($data);
    }

    /**
     * Add a work to database
     *
     * @param Works $workObject
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     */
    public function addWork($workObject)
    {
        return ($this->workDAO->addWork($workObject)>0);
    }

    /**
     * Delete a work in the database
     *
     * @param int $workId
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     */
    public function deleteWork($workId)
    {
        return $this->workDAO->deleteWork($workId);
    }

    /**
     * Get a work from database
     *
     * @param  int $workId
     *
     * @return Works
     *
     * @author khaln@tech.est-rouge.com
     */
    public function getWork($workId)
    {
        $item = $this->workDAO->getWork($workId);

        if(empty($item))
            return null;

        return new Works($item->id, $item->work_name, $item->start_date, $item->end_date, $item->id_status);
    }

    /**
     * Update a work in database
     *
     * @param Works $workObject
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     */
    public function updateWorkByEdit($workObject)
    {
        return $this->workDAO->updateWorkByEdit($workObject);
    }

    /**
     * Update a work in database
     *
     * @param Works $workObject
     *
     * @return bool
     *
     * @author khaln@tech.est-rouge.com
     */
    public function updateWorkByResize($workObject)
    {
        return $this->workDAO->updateWorkByResize($workObject);
    }
}