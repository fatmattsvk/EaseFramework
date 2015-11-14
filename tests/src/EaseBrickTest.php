<?php

require_once 'EaseSandTest.php';

class EaseBrickTester extends EaseBrick
{

    public $myTable = 'test';

}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-20 at 14:41:35.
 */
class EaseBrickTest extends EaseSandTest
{

    /**
     * @var EaseBrick
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new EaseBrickTester;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers EaseBrick::getstatusMessages
     */
    public function testgetstatusMessages()
    {
        $this->object->cleanMessages();
        $this->object->addStatusMessage('Message', 'warning');
        $this->object->addStatusMessage('Message', 'debug');
        $this->object->addStatusMessage('Message', 'error');
        $messages = $this->object->getstatusMessages();
        $this->assertEquals(3, count($messages));
    }

    /**
     * @covers EaseBrick::setObjectName
     * @todo   Implement testSetObjectName().
     */
    public function testSetObjectName()
    {
        $this->object->setObjectName('Testing');
        $this->assertEquals('Testing', $this->object->getObjectName());
        $this->object->setObjectName();
        $this->assertEquals(get_class($this->object), $this->object->getObjectName());
    }

    /**
     * @covers EaseBrick::setObjectIdentity
     * @todo   Implement testSetObjectIdentity().
     */
    public function testSetObjectIdentity()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setUpUser
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
     * @covers EaseBrick::getUser
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
     * @covers EaseBrick::addStatusMessage
     * @todo   Implement testAddStatusMessage().
     */
    public function testAddStatusMessage()
    {
        $this->object->addStatusMessage('Testing');
        $messages = $this->object->getStatusMessages();
        $this->assertEquals($messages, $messages);
    }

    /**
     * @covers EaseBrick::easeAddSlashes
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
     * @covers EaseBrick::getColumnsFromMySQL
     * @todo   Implement testGetColumnsFromMySQL().
     */
    public function testGetColumnsFromMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getDataFromMySQL
     * @todo   Implement testGetDataFromMySQL().
     */
    public function testGetDataFromMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::loadFromMySQL
     * @todo   Implement testLoadFromMySQL().
     */
    public function testLoadFromMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getAllFromMySQL
     * @todo   Implement testGetAllFromMySQL().
     */
    public function testGetAllFromMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::mySqlUp
     * @todo   Implement testMySqlUp().
     */
    public function testMySqlUp()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::saveSqlStruct
     * @todo   Implement testSaveSqlStruct().
     */
    public function testSaveSqlStruct()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::saveSqlStructArrays
     * @todo   Implement testSaveSqlStructArrays().
     */
    public function testSaveSqlStructArrays()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::loadSqlStruct
     * @todo   Implement testLoadSqlStruct().
     */
    public function testLoadSqlStruct()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::saveObjectSqlStruct
     * @todo   Implement testSaveObjectSqlStruct().
     */
    public function testSaveObjectSqlStruct()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::loadObjectSqlStruct
     * @todo   Implement testLoadObjectSqlStruct().
     */
    public function testLoadObjectSqlStruct()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setupPartners
     * @todo   Implement testSetupPartners().
     */
    public function testSetupPartners()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getDbFunctions
     * @todo   Implement testGetDbFunctions().
     */
    public function testGetDbFunctions()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setUpColumnsRoles
     * @todo   Implement testSetUpColumnsRoles().
     */
    public function testSetUpColumnsRoles()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::updateToMySQL
     * @todo   Implement testUpdateToMySQL().
     */
    public function testUpdateToMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::saveToMySQL
     * @todo   Implement testSaveToMySQL().
     */
    public function testSaveToMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::insertToMySQL
     * @todo   Implement testInsertToMySQL().
     */
    public function testInsertToMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::save
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
     * @covers EaseBrick::insert
     * @todo   Implement testInsert().
     */
    public function testInsert()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setReferences
     * @todo   Implement testSetReferences().
     */
    public function testSetReferences()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::isSynchronized
     * @todo   Implement testIsSynchronized().
     */
    public function testIsSynchronized()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setTagIDS
     * @todo   Implement testSetTagIDS().
     */
    public function testSetTagIDS()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::deleteFromMySQL
     * @todo   Implement testDeleteFromMySQL().
     */
    public function testDeleteFromMySQL()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::takeToData
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
     * @covers EaseBrick::getMySQLList
     * @todo   Implement testGetMySQLList().
     */
    public function testGetMySQLList()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::takemyTable
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
     * @covers EaseBrick::getmyKeyColumn
     * @todo   Implement testGetmyKeyColumn().
     */
    public function testGetmyKeyColumn()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::MyIDExists
     * @todo   Implement testMyIDExists().
     */
    public function testMyIDExists()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::MSIDExists
     * @todo   Implement testMSIDExists().
     */
    public function testMSIDExists()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getMSKeyColumn
     * @todo   Implement testGetMSKeyColumn().
     */
    public function testGetMSKeyColumn()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getMyKey
     * @todo   Implement testGetMyKey().
     */
    public function testGetMyKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setMyKey
     * @todo   Implement testSetMyKey().
     */
    public function testSetMyKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::getMSKey
     * @todo   Implement testGetMSKey().
     */
    public function testGetMSKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setMSKey
     * @todo   Implement testSetMSKey().
     */
    public function testSetMSKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setMSKeyColumn
     * @todo   Implement testSetMSKeyColumn().
     */
    public function testSetMSKeyColumn()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setmyKeyColumn
     * @todo   Implement testSetmyKeyColumn().
     */
    public function testSetmyKeyColumn()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setmyTable
     * @todo   Implement testSetmyTable().
     */
    public function testSetmyTable()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::setMSTable
     * @todo   Implement testSetMSTable().
     */
    public function testSetMSTable()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::mySQLTableExist
     * @depends methodName
     */
    public function testMySQLTableExist()
    {
        $this->assertTrue($this->object->mySQLTableExist('test'));
        $this->assertFalse($this->object->mySQLTableExist('Nonexist'));
    }

    /**
     * @covers EaseBrick::getMySQLItemsCount
     * @todo   Implement testGetMySQLItemsCount().
     */
    public function testGetMySQLItemsCount()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseBrick::lettersOnly
     * @todo   Implement testLettersOnly().
     */
    public function testLettersOnly()
    {
        $this->assertEquals(
            '1a2b3c', $this->object->lettersOnly('1/a:2@b#3!c')
        );
    }

}
