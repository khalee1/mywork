<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/16/18
 * Time: 9:23 AM
 */

namespace Kd\Models\DAO;

class ModelDAO
{
    protected $db = null;

    function __construct()
    {
       $this->db = Database::getInstance()->getDb();
    }
}