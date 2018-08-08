<?php

namespace  Kd\Models\DAO;
class Work_DAO
{
    /**
     * @param object $db A PDO database connection
     */
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
     */
    public function getAllWork()
    {
        $sql = "SELECT w.id , w.work_name, w.start_date , w.end_date, w.id_status , s.status_name , s.color  FROM work AS w ".
                "JOIN status AS s ON w.id_status = s.id ORDER BY w.id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get all status from database
     */
    public function getAllStatus()
    {
        $sql = "SELECT s.id, s.status_name , s.color  FROM status AS s ORDER BY s.id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a work to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $work_name Work Name
     * @param string $start_date Start Date
     * @param string $end_date End Date
     * @param string $id_status ID Status
     */
    public function addWork($work_name , $start_date , $end_date , $id_status)
    {
        $sql = "INSERT INTO work (work_name, start_date, end_date , id_status) VALUES (:work_name, :start_date, :end_date , :id_status)";
        $query = $this->db->prepare($sql);
        $parameters = array(':work_name' => $work_name, ':start_date' => $start_date, ':end_date' => $end_date , ':id_status' => $id_status);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }

    /**
     * Delete a work in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $id Id of work
     */
    public function deleteWork($id)
    {
        $sql = "DELETE FROM work WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a work from database
     */
    public function getWork($id_work)
    {
        $sql = "SELECT w.id , w.work_name, w.start_date , w.end_date, w.id_status , s.status_name , s.color  FROM work AS w ".
                "JOIN status AS s ON w.id_status = s.id ".
                "WHERE w.id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id_work);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a work in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $work_name Work Name
     * @param string $start_date Start Date
     * @param string $end_date End Date
     * @param string $id_status ID Status
     * @param int $id_work Id of work
     */
    public function updateWork($work_name , $start_date , $end_date , $id_status , $id_work)
    {
        $sql = "UPDATE work SET work_name = :work_name, start_date = :start_date , end_date = :end_date , id_status = :id_status
                WHERE id = :id_work";
        $query = $this->db->prepare($sql);
        $parameters = array(':work_name' => $work_name,
                            ':start_date' => $start_date,
                            ':end_date' => $end_date,
                            ':id_status' => $id_status,
                            ':id_work' => $id_work
                            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
    public function updateWorkByResize( $start_date , $end_date , $id_work)
    {
        $sql = "UPDATE work SET  start_date = :start_date , end_date = :end_date 
                WHERE id = :id_work";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':id_work' => $id_work
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }


}
