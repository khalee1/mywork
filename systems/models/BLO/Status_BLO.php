<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/16/18
 * Time: 10:17 AM
 */

namespace Kd\Models\BLO;


use Kd\Models\DAO\Status_DAO;
use Kd\Models\DTO\Status;

class Status_BLO
{
    public $statusDAO = null;

    function __construct()
    {
        $this->statusDAO = new Status_DAO();
    }

    /**
     * Get all status from database
     *
     * @param null
     *
     * @return array
     *
     * @author  khaln@tech.est-rouge.com
     */
    public function getAllStatus()
    {
        $result = $this->statusDAO->getAllStatus();

        if (count($result) <= 0) return null;

        $status = null;
        $listStatus = array();

        foreach ($result as $item) {
            $status = new Status($item->id, $item->status_name, $item->color);
            $listStatus[] = $status;
        }

        return $listStatus;
    }
}