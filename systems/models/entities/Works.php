<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/14/18
 * Time: 3:20 PM
 */

namespace Kd\Models\Entities;

class Works
{

    private $id;

    private $workName;

    private $startDate;

    private $endDate;

    private $status;

    function __construct($id , $workName , $startDate ,$endDate , $status)
    {
        $this->id = $id;
        $this->workName = $workName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getWorkName()
    {
        return $this->workName;
    }

    public function setWorkName($workName)
    {
        $this->workName = $workName;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}