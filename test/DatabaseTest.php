<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/17/18
 * Time: 4:39 PM
 */

use Kd\Models\DAO\Work_DAO;
use Kd\Models\Entities\Works;

require_once 'Generic_Tests_DatabaseTestCase.php';


class DatabaseTest extends Generic_Tests_DatabaseTestCase
{
    /**
     * @var Work_DAO
     */
    private $dao = null;

    public function setUp()
    {
        parent::setUp();
        $this->dao = new Work_DAO();
    }

    public function testAddWorkSuccess()
    {
        $work = new Works('', 'Test add', '2018-08-14 01:40:00', '2018-08-19 01:40:00', 2);

        $this->dao->addWork($work);

        $params = array(
            'work_name' => $work->getWorkName(),
            'start_date' => $work->getStartDate(),
            'end_date' => $work->getEndDate(),
            'id_status' => $work->getStatus()
        );

        $this->assertSeeInDatabase('work', $params);
    }

    /**
     * @throws Exception
     * @expectedException  PDOException
     */
    public function testAddWorkFail()
    {
        $work = new Works('', 'kha_lee_12', '2018-08-14 01:40:00', '', 2);

        $this->dao->addWork($work);
    }

    public function testDeleteWorkSuccess()
    {
        $work = new Works('', 'Test delete', '2018-08-14 01:40:00', '2018-08-19 01:40:00', 2);

        $lastIDInsert = $this->dao->addWork($work);

        $this->dao->deleteWork($lastIDInsert);

        $params = array(
            'id' => $lastIDInsert
        );

        $this->assertNotSeeInDatabase('work', $params);
    }

    public function testUpdateWorkSuccess()
    {
        $work = new Works('', 'Test add', '2018-08-14 01:40:00', '2018-08-19 01:40:00', 2);

        $lastIDInsert = $this->dao->addWork($work);

        $work->setId($lastIDInsert);
        $work->setWorkName('Test Update');

        $this->dao->updateWorkByEdit($work);

        $params = array(
            'id' => $work->getId(),
            'work_name' => $work->getWorkName(),
            'start_date' => $work->getStartDate(),
            'end_date' => $work->getEndDate(),
            'id_status' => $work->getStatus()
        );

        $this->assertSeeInDatabase('work', $params);
    }

    protected function getDataSet()
    {
        //TO-DO SomeThing for fun but can't delete function
    }
}