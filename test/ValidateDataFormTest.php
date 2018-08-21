<?php

use \PHPUnit\Framework\TestCase;
use Kd\Core\Verify\ValidateDataForm;

class ValidateDataFormTest extends TestCase
{

    public function testCheckNotNullReturnTrue()
    {
        $data = "Param Not Null";

        $result = ValidateDataForm::checkNotNull($data);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException Exception
     */
    public function testCheckNotNullThrowExceptionParamNull()
    {
        $data = null;

        ValidateDataForm::checkNotNull($data);
    }

    public function testCheckIsNumberGreaterThanZeroReturnTrue()
    {
        $data = 12;

        $result = ValidateDataForm::checkIsNumberGreaterThanZero($data);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     * @expectedException Exception
     */
    public function testCheckIsNumberGreaterThanZeroThrowExceptionNumberLessThanZero()
    {
        $data = '0';

        ValidateDataForm::checkIsNumberGreaterThanZero($data);
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
        ValidateDataForm::checkIsNumberGreaterThanZero($data);
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
        $result = ValidateDataForm::checkIsDateStartLessThanDateEnd($dayStart, $dayEnd);
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
        ValidateDataForm::checkIsDateStartLessThanDateEnd($dayStart, $dayEnd);
    }

    public function testCheckPostHaveKeyReturnTrue()
    {
        $dataListKey = array('id_work', 'work_name');
        $dataPost = array(
            'id_work' => 2,
            'work_name' => 'abc'
        );

        $result = ValidateDataForm::checkPostHaveKey($dataListKey, $dataPost);
        $this->assertTrue($result);
    }

    /**
     * @throws \Kd\Core\Verify\PostException
     * @expectedException \Kd\Core\Verify\PostException
     */
    public function testCheckPostHaveKeyThrowExceptionPOSTHaveNotKey()
    {
        $dataListKey = array('id_work', 'work');
        $dataPost = array(
            'id_work' => 2,
            'work_name' => 'abc'
        );

        ValidateDataForm::checkPostHaveKey($dataListKey, $dataPost);
    }
}
