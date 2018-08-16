<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/16/18
 * Time: 9:21 AM
 */

namespace Kd\Models\DAO;

use  Kd\Models\DAO\ModelDAO as ModelDAO;

class Status_DAO extends ModelDAO
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all status from database
     *
     * @param null
     *
     * @return list Status
     *
     * @author  khaln@tech.est-rouge.com
     */
    public function getAllStatus()
    {
        $sql = "SELECT s.id, s.status_name , s.color FROM status AS s ORDER BY s.id ASC";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

}