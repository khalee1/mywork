<?php

namespace Kd\Models\DAO;

use Kd\Models\Entities\Works;

class Work_DAO
{
    /**
     * @param object $db A PDO database connection
     */
    private $db = null;

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all works from database
     *
     * @param null
     *
     * @return list object
     *
     * @author  khaln@tech.est-rouge.com
     */
    public function getAllWork()
    {
        $sql = "SELECT w.id , w.work_name, w.start_date , w.end_date, w.id_status , s.status_name , s.color  FROM work AS w " .
            "JOIN status AS s ON w.id_status = s.id ORDER BY w.id DESC";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
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

    /**
     * Add a work to database
     *
     * @param Works $work
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     */
    public function addWork($work)
    {
        $sql = "INSERT INTO work (work_name, start_date, end_date , id_status) " .
            "VALUES (:work_name, :start_date, :end_date , :id_status)";

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':work_name' => $work->getWorkName(),
            ':start_date' => $work->getStartDate(),
            ':end_date' => $work->getEndDate(),
            ':id_status' => $work->getStatus()
        );

        return $query->execute($parameters);
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
        $sql = "DELETE FROM work WHERE id = :id";

        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $workId);

        return $query->execute($parameters);
    }

    /**
     * Get a work from database
     *
     * @param  int $workId
     *
     * @return object
     *
     * @author khaln@tech.est-rouge.com
     */
    public function getWork($workId)
    {
        $sql = "SELECT w.id , w.work_name, w.start_date , w.end_date, w.id_status , s.status_name , s.color FROM work AS w " .
            "JOIN status AS s ON w.id_status = s.id " .
            "WHERE w.id = :id LIMIT 1";

        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $workId);

        $query->execute($parameters);

        return $query->fetch();
    }

    /**
     * Update a work in database
     *
     * @param Works $work
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     */
    public function updateWorkByEdit($work)
    {
        $sql = "UPDATE work SET work_name = :work_name, start_date = :start_date , end_date = :end_date , id_status = :id_status " .
            "WHERE id = :id_work";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':id_work' => $work->getId(),
            ':work_name' => $work->getWorkName(),
            ':start_date' => $work->getStartDate(),
            ':end_date' => $work->getEndDate(),
            ':id_status' => $work->getStatus()
        );

        return $query->execute($parameters);
    }

    /**
     * Update a work in database
     *
     * @param Works $work
     *
     * @return bool
     *
     * @author khaln@tech.est-rouge.com
     */
    public function updateWorkByResize($work)
    {
        $sql = "UPDATE work SET  start_date = :start_date , end_date = :end_date WHERE id = :id_work";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':id_work' => $work->getId(),
            ':start_date' => $work->getStartDate(),
            ':end_date' => $work->getEndDate()
        );

        return $query->execute($parameters);
    }
}
