<?php

use \PHPUnit\Framework\TestCase;
use Kd\Core\Verify\Verify_Data;

class VerifyDataTest extends TestCase
{

    public function testCheckNotNullReturnTrue()
    {
        $data = "Param Not Null";

        $result = Verify_Data::checkNotNull($data);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException Exception
     */
    public function testCheckNotNullThrowExceptionParamNull()
    {
        $data = null;

        Verify_Data::checkNotNull($data);
    }

    public function testCheckIsNumberGreaterThanZeroReturnTrue()
    {
        $data = 12;

        $result = Verify_Data::checkIsNumberGreaterThanZero($data);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException Exception
     */
    public function testCheckIsNumberGreaterThanZeroThrowExceptionNumberLessThanZero()
    {
        $data = '0';

        Verify_Data::checkIsNumberGreaterThanZero($data);
    }

    /**
     * @param var $data
     *
     * @throws Exception
     *
     * @expectedException Exception
     *
     * @dataProvider dataForTestCheckIsNumberGreaterThanZeroThrowExceptionInputNotTypeInt
     */
    public function testCheckIsNumberGreaterThanZeroThrowExceptionInputNotTypeInt($data)
    {
        Verify_Data::checkIsNumberGreaterThanZero($data);
    }


    public function dataForTestCheckIsNumberGreaterThanZeroThrowExceptionInputNotTypeInt()
    {
        return [[12.12],
                ['23.12'],
                ['12xfd'],
                ];
    }

    public function testCheckIsDateStartLessThanDateEndReturnTrue()
    {
        $dayStart = '2018-08-14 01:40:00';
        $dayEnd = '2018-08-19 01:40:00';
        $result = Verify_Data::checkIsDateStartLessThanDateEnd($dayStart, $dayEnd);
        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException Exception
     */
    public function testCheckIsDateStartLessThanDateEndThrowExceptionDateStartGreaterThanDateEnd()
    {
        $dayStart = '2018-08-20 01:40:00';
        $dayEnd = '2018-08-19 01:40:00';
        Verify_Data::checkIsDateStartLessThanDateEnd($dayStart, $dayEnd);
    }

    public function testCheckPostReturnTrue()
    {
        $dataListKey = array('id_work', 'work_name');
        $dataPost = array('id_work' => 2,
            'work_name' => 'abc');

        $result = Verify_Data::checkPost($dataListKey, $dataPost);
        $this->assertTrue($result);
    }

    /**
     * @throws \Kd\Core\Verify\PostException
     * @expectedException \Kd\Core\Verify\PostException
     */
    public function testCheckPostThrowExceptionPOSTHaveNotKey()
    {
        $dataListKey = array('id_work', 'work');
        $dataPost = array('id_work' => 2,
            'work_name' => 'abc');

        Verify_Data::checkPost($dataListKey, $dataPost);
    }
}
