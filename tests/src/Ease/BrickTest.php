<?php

namespace Test\Ease;

use Ease\Brick;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:23:11.
 */
class BrickTest extends SandTest
{
    /**
     * @var Brick
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Brick();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        if (is_object($this->object->dblink)) {
            $this->object->dblink->close();
        }
    }

    /**
     * @covers Ease\Brick::getstatusMessages
     */
    public function testgetStatusMessages()
    {
        $this->object->cleanMessages();
        $this->object->addStatusMessage('Message', 'mail');
        $this->object->addStatusMessage('Message', 'warning');
        $this->object->addStatusMessage('Message', 'debug');
        $this->object->addStatusMessage('Message', 'error');
        $messages = $this->object->getStatusMessages();
        $this->assertEquals(4, count($messages));
    }

    /**
     * @covers Ease\Brick::setObjectName
     */
    public function testSetObjectName()
    {
        parent::testSetObjectName();
        $this->object->setMyKey(123);
        $this->object->setObjectName();
        $this->assertEquals(get_class($this->object).'@123',
            $this->object->getObjectName());
    }

    /**
     * @covers Ease\Brick::addStatusMessage
     */
    public function testaddStatusMessage()
    {
        $this->object->addStatusMessage('Testing');
        $this->object->addStatusMessage('email Message', 'email');
        $this->object->addStatusMessage('warning Message', 'warning');
        $this->object->addStatusMessage('debug Message', 'debug');
        $this->object->addStatusMessage('error Message', 'error');
        $this->object->addStatusMessage('success Message', 'success');
        $messages = $this->object->getStatusMessages();
        $this->assertEquals($messages, $messages);
    }

    /**
     * @covers Ease\Brick::getColumnsFromSQL
     */
    public function testGetColumnsFromSQL()
    {
        if (\Ease\Shared::db()->isConnected()) {
            $this->object->takemyTable('test');
            $this->assertNull($this->object->getColumnsFromSQL(null));
            $this->assertEquals([0 => ['id' => '3']],
                $this->object->getColumnsFromSQL('id', 3));

            $ids = $this->object->getColumnsFromSQL(array('id'));
            $this->assertEquals([0 => ['id' => 3], 1 => ['id' => 2]], $ids);
            $names = $this->object->getColumnsFromSQL(array('name'));
            $this->assertEquals($names,
                [0 => ['name' => 'alpha'], 1 => ['name' => 'beta']]);
            $all = $this->object->getColumnsFromSQL('*', null, 'name', 'id');
            $this->assertEquals([2 => ['id' => '2', 'name' => 'beta', 'date' => '2015-11-18 00:00:00'],
                3 => ['id' => '3', 'name' => 'alpha', 'date' => '2015-11-17 00:00:00'], ],
                $all);
            $this->assertNull($this->object->getColumnsFromSQL('*', []));
            $some = $this->object->getColumnsFromSQL(['name', 'id'],
                "test.date = '2015-11-18 00:00:00'");
            $this->assertEquals([0 => ['name' => 'beta', 'id' => 2]], $some);
        }
    }

    /**
     * @covers Ease\Brick::getDataFromSQL
     *
     * @todo   Implement testGetDataFromSQL().
     */
    public function testGetDataFromSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::setUpUser
     *
     * @todo   Implement testSetUpUser().
     */
    public function testSetUpUser()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::getUser
     *
     * @todo   Implement testGetUser().
     */
    public function testGetUser()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::easeAddSlashes
     *
     * @todo   Implement testEaseAddSlashes().
     */
    public function testEaseAddSlashes()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::loadFromSQL
     *
     * @todo   Implement testLoadFromSQL().
     */
    public function testLoadFromSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::getAllFromSQL
     *
     * @todo   Implement testGetAllFromSQL().
     */
    public function testGetAllFromSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::updateToSQL
     *
     * @todo   Implement testUpdateToSQL().
     */
    public function testUpdateToSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::saveToSQL
     *
     * @todo   Implement testSaveToSQL().
     */
    public function testSaveToSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::insertToSQL
     *
     * @todo   Implement testInsertToSQL().
     */
    public function testInsertToSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::save
     *
     * @todo   Implement testSave().
     */
    public function testSave()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::deleteFromSQL
     *
     * @todo   Implement testDeleteFromSQL().
     */
    public function testDeleteFromSQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::takeToData
     *
     * @todo   Implement testTakeToData().
     */
    public function testTakeToData()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::getSQLList
     *
     * @todo   Implement testGetSQLList().
     */
    public function testGetSQLList()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::takemyTable
     *
     * @todo   Implement testTakemyTable().
     */
    public function testTakemyTable()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::getmyKeyColumn
     */
    public function testGetmyKeyColumn()
    {
        $this->object->setmyKeyColumn('test');
        $this->assertEquals('test', $this->object->getmyKeyColumn());
    }

    /**
     * @covers Ease\Brick::getMyTable
     */
    public function testGetMyTable()
    {
        $this->object->setmyTable('testing');
        $this->assertEquals('testing', $this->object->getMyTable());
    }

    /**
     * @covers Ease\Brick::getMyKey
     *
     * @todo   Implement testGetMyKey().
     */
    public function testGetMyKey()
    {
        $this->object->setmyKey('test');
        $this->assertEquals('test', $this->object->getmyKey());
    }

    /**
     * @covers Ease\Brick::setMyKey
     */
    public function testSetMyKey()
    {
        $this->object->setmyKey('test');
        $this->assertEquals('test', $this->object->getmyKey());
    }

    /**
     * @covers Ease\Brick::setmyKeyColumn
     */
    public function testSetmyKeyColumn()
    {
        $this->object->setmyKeyColumn('test');
        $this->assertEquals('test', $this->object->getmyKeyColumn());
    }

    /**
     * @covers Ease\Brick::setmyTable
     */
    public function testSetmyTable()
    {
        $this->object->setmyTable('test');
        $this->assertEquals('test', $this->object->getMyTable());
    }

    /**
     * @covers Ease\Brick::mySQLTableExist
     *
     * @todo   Implement testMySQLTableExist().
     */
    public function testMySQLTableExist()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::getSQLItemsCount
     *
     * @todo   Implement testGetSQLItemsCount().
     */
    public function testGetSQLItemsCount()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::lettersOnly
     */
    public function testLettersOnly()
    {
        $this->assertEquals('1a2b3', $this->object->lettersOnly('1a2b_3'));
    }

    /**
     * @covers Ease\Brick::searchColumns
     *
     * @todo   Implement testSearchColumns().
     */
    public function testSearchColumns()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Brick::reindexArrayBy
     */
    public function testReindexArrayBy()
    {
        $a = [
            ['id' => '2', 'name' => 'b'],
            ['id' => '1', 'name' => 'a'],
            ['id' => '3', 'name' => 'c'],
        ];
        $b = [
            '1' => ['id' => '1', 'name' => 'a'],
            '2' => ['id' => '2', 'name' => 'b'],
            '3' => ['id' => '3', 'name' => 'c'],
        ];

        parent::testReindexArrayBy();
        $this->object->setmyKeyColumn('id');
        $this->assertEquals($b, $this->object->reindexArrayBy($a));
    }
}
