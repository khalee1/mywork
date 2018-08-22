<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use Kd\Core\Config\Config;

abstract class Generic_Tests_DatabaseTestCase extends TestCase
{
    use TestCaseTrait;

    static private $pdo = null;

    /**
     * @var \PHPUnit\DbUnit\Database\DefaultConnection
     */
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {

                self::$pdo = \Kd\Models\DAO\Database::getInstance()->getDb();
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo);
        }

        return $this->conn;
    }

    public function setUp()
    {
        parent::setUp();
        $this->getConnection();
        $this->conn->getConnection()->beginTransaction();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->conn->getConnection()->rollBack();
    }

    /**
     * @param array $param
     *
     * @return string
     */
    public function stringQueryBuilder($param)
    {
        $stringQuery = '';

        foreach ($param as $key => $value) {
            $stringQuery = $stringQuery . $key . ' = \'' . $value . '\' AND ';
        }

        return rtrim($stringQuery, ' AND ');
    }

    /**
     * @param string $tableName
     *
     * @param array $param
     *
     * @author khaln@tech.est-rouge.com
     */
    public function assertSeeInDatabase($tableName, $param)
    {
        $result = count($this->seeInDatabase($tableName, $param));

        $this->assertGreaterThan(0, $result);
    }

    public function assertNotSeeInDatabase($tableName, $param)
    {
        $result = $this->seeInDatabase($tableName, $param);

        $this->assertEmpty($result);
    }

    /**
     * @param string $tableName
     *
     * @param array $param
     *
     * @return object
     *
     * @author khaln@tech.est-rouge.com
     */
    private function seeInDatabase($tableName, $param)
    {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $this->stringQueryBuilder($param);

        $query = self::$pdo->query($sql);

        return $query->fetch();
    }
}