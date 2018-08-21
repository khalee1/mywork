<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/14/18
 * Time: 3:42 PM
 */

namespace Kd\Models\DTO;


class Status
{

    private $statusId;

    private $statusName;

    private $color;

    /**
     * Status constructor.
     * @param $statusId
     * @param $statusName
     * @param $color
     */
    public function __construct($statusId, $statusName, $color)
    {
        $this->statusId = $statusId;
        $this->statusName = $statusName;
        $this->color = $color;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

    public function getStatusName()
    {
        return $this->statusName;
    }

    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;
    }

    public function getColor()
    {
        return $this->color;
    }

   public function setColor($color)
    {
        $this->color = $color;
    }
}