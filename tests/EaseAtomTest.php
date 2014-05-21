<?php

/**
 * Základní objekty systému
 * 
 * @package    EaseUnitTests
 * @subpackage UnitTests
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2012 Vitex@hippy.cz (G) 
 */


/**
 * Test class for EaseAtom.
 * Generated by PHPUnit on 2012-03-17 at 23:53:07.
 *
 * @package    EaseUnitTests
 * @subpackage UnitTests
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2012 Vitex@hippy.cz (G)
 */
class EaseAtomTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var EaseAtom
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new EaseAtom;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers EaseAtom::getObjectName
     */
    public function testgetObjectName()
    {
        $this->assertNotEmpty($this->object->getObjectName());
    }

    /**
     * test přidání stavové zprávy
     */
    public function testaddStatusMessage()
    {
        $this->object->cleanMessages();
        $this->object->addStatusMessage(_('test přidání stavové zprávy'), 'info');
        $this->assertNotEmpty($this->object->StatusMessages);
    }

    /**
     * Test přidání stavových zpráv
     * @depends testaddStatusMessage
     */
    public function testaddStatusMessages()
    {
        $this->object->addStatusMessages(array('info' => array('test msg 1'), 'debug' => array('test msg 2')));
        $this->assertArrayHasKey('info', $this->object->StatusMessages);
    }

    /**
     * Test smazání fronty zpráv
     */
    public function testcleanMessages()
    {
        $this->object->addStatusMessage('Clean Test');
        $this->object->CleanMessages();
        $this->assertEmpty($this->object->StatusMessages, _('Stavové zprávy jsou mazány'));
    }

    /**
     * 
     */
    public function testgetStatusMessages()
    {
        $this->object->addStatusMessage('Message','warning');
        $this->object->addStatusMessage('Message','debug');
        $this->object->addStatusMessage('Message','error');
        $Messages = $this->object->getStatusMessages();
        print_r($Messages);
        $this->assertArrayHasKey( 2, $Messages);
    }

    /**
     * Test převzetí stavových práv
     */
    public function testtakeStatusMessages()
    {
        $MsgSrc = new EaseAtom();
        $this->object->cleanMessages();
        $MsgSrc->addStatusMessage('testing info message', 'info');
        $MsgSrc->addStatusMessage('testing success message', 'success');
        $this->object->takeStatusMessages($MsgSrc);
        $this->object->takeStatusMessages($MsgSrc->StatusMessages);
        $this->assertArrayHasKey('info', $this->object->StatusMessages);
    }

    /**
     * Test odslashování systémových souborů
     */
    public function testsysFilename()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $this->assertContains('\\\\', $this->object->sysFilename('/'), _('konverze souborů pod windows')
            );
        } else {
            $this->assertContains('/', $this->object->sysFilename('\\\\'), _('konverze souborů pod unixem')
            );
        }
    }

}

?>