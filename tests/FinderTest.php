<?php
class MyFinder extends Finder {
    const TABLE_NAME = 'object_table';
    
    public $id;
    public $name;
}

class FinderTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Finder
     */
    protected $object;
    protected $conn;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new MyFinder();

        // Attempt to create DB connection
        try {
            $conn = new PDO(DB_DSN, DB_USER, DB_PASS);
        } catch (PDOException $error) {
            die('DB Connection failed: '.$error->getMessage());
        }
        
        $this->driver = $conn->getAttribute(PDO::ATTR_DRIVER_NAME);
        if ($this->driver === 'mysql') {
            $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        }

        Record::connection($conn);
        Record::getConnection()->exec("set names 'utf8'");

        $this->conn = $conn;
        $this->object->connection($conn);
    }


    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        $this->conn->exec("DROP TABLE object_table");

        $this->object = null;
        $this->conn = null;
        Record::$__QUERIES__ = array();
        Record::$__CONN__ = false;
    }

    public function testObjectCreation() {
        $expected = new MyFinder();
        $expected->id = 1;
        $expected->name = 'an object';

        $actual = new MyFinder(array(1, 'an object'));
        $this->assertNotEquals($expected, $actual);

        $actual = new MyFinder(array('id' => 1, 'name' => 'an object'));
        $this->assertEquals($expected, $actual);

        $actual = new MyFinder(array());
        $this->assertNotEquals($expected, $actual);

        $actual = new MyFinder(false);
        $this->assertNotEquals($expected, $actual);
    }

    public function testFindAllById() {
        // Create table
        if ($this->driver === 'mysql') {
            $this->conn->exec("CREATE TABLE object_table (
                id int(11) unsigned NOT NULL auto_increment,
                name text,
                PRIMARY KEY  (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
        }
        
        if ($this->driver === 'sqlite') {
            $this->conn->exec("CREATE TABLE object_table (
                id INTEGER NOT NULL PRIMARY KEY,
                name varchar(100) default NULL
            )");
        }
        
        if ($this->driver === 'pgsql') {
            $this->conn->exec("CREATE TABLE object_table (
                id serial,
                name text,
                PRIMARY KEY (id)
            )");
        }

        // Test with one record
        $obj = new MyFinder();
        $obj->name = 'Object # 1';
        $this->assertTrue($obj->save());
        
        $expected = new MyFinder();
        $expected->id = 1;
        $expected->name = 'Object # 1';
        $expected = array($expected);
        $actual = MyFinder::findAllById(1);
        $this->assertInternalType('array', $actual);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf('MyFinder', $actual[0]);
        $this->assertEquals($expected[0]->id, $actual[0]->id);

        // Test with two records
        $obj = new MyFinder();
        $obj->name = 'Object # 2';
        $this->assertTrue($obj->save());

        $expected = new MyFinder();
        $expected->id = 2;
        $expected->name = 'Object # 2';
        $expected = array($expected);
        $actual = MyFinder::findAllById(2);
        $this->assertInternalType('array', $actual);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf('MyFinder', $actual[0]);
        $this->assertEquals($expected[0]->id, $actual[0]->id);
    }

    public function testFindByName() {
        // Create table
        if ($this->driver === 'mysql') {
            $this->conn->exec("CREATE TABLE object_table (
                id int(11) unsigned NOT NULL auto_increment,
                name text,
                PRIMARY KEY  (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
        }
        
        if ($this->driver === 'sqlite') {
            $this->conn->exec("CREATE TABLE object_table (
                id INTEGER NOT NULL PRIMARY KEY,
                name varchar(100) default NULL
            )");
        }
        
        if ($this->driver === 'pgsql') {
            $this->conn->exec("CREATE TABLE object_table (
                id serial,
                name text,
                PRIMARY KEY (id)
            )");
        }

        // Test with one record
        $obj = new MyFinder();
        $obj->name = 'Object1';
        $this->assertTrue($obj->save());
        
        $expected = new MyFinder();
        $expected->id = 1;
        $expected->name = 'Object1';
        $expected = array($expected);
        $actual = MyFinder::findAllByName('Object1');
        $this->assertInternalType('array', $actual);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf('MyFinder', $actual[0]);
        $this->assertEquals($expected[0]->id, $actual[0]->id);

        // Test with two records
        $obj = new MyFinder();
        $obj->name = 'Object2';
        $this->assertTrue($obj->save());

        $expected = new MyFinder();
        $expected->id = 2;
        $expected->name = 'Object2';
        $expected = array($expected);
        $actual = MyFinder::findAllByName('Object2');
        $this->assertInternalType('array', $actual);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf('MyFinder', $actual[0]);
        $this->assertEquals($expected[0]->id, $actual[0]->id);

    }
}

?>
