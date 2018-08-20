<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/16/18
 * Time: 9:54 AM
 */

namespace Kd\Models\DAO;

use Kd\Core\Config\Config;
use PDO;

class Database
{
    /**
     * @var PDO
     */
    protected $db = null;

    public $config = null;

    private static $instance;

    public static function getInstance(): Database
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    function __construct()
    {
        $this->config = new Config();
        $this->config->load( 'config');
        $this->openConnectionToDatabase($this->config->item('db'));
    }

    /**
     * Connection to Database
     *
     * @param array $configDB
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    private function openConnectionToDatabase($configDB)
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        $this->db = new PDO($configDB['type'] .
            ':host=' . $configDB['host'] .
            ';dbname=' . $configDB['schema'] .
            ';charset=' . $configDB['charset'],
            $configDB['user'],
            $configDB['pass'],
            $options
        );
    }

    /**
     * @return null
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param null $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
}