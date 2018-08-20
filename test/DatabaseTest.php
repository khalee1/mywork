<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/17/18
 * Time: 4:39 PM
 */
use PHPUnit\Framework\TestCase;
use Kd\Models\DAO\Work_DAO;
use Kd\Models\Entities\Works;


class DatabaseTest extends TestCase
{
    public function  testAddWorkSuccess()
    {
        $dao = new Work_DAO();

        $work = new Works('','kha_lee','2018-08-14 01:40:00' ,'2018-08-19 01:40:00' , 2);

        $result = $dao->addWork($work);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException  PDOException
     */
    public function  testAddWorkFail()
    {
        $dao = new Work_DAO();

        $work = new Works('','kha_lee_12','2018-08-14 01:40:00' ,'' , 2);

        $dao->addWork($work);
    }
}