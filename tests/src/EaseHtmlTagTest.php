<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-07-19 at 00:19:03.
 */
class EaseHtmlTagTest extends EasePageTest
{

    /**
     * @var EaseHtmlTag
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new EaseHtmlTag;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers EaseHtmlTag::setObjectName
     * @todo   Implement testSetObjectName().
     */
    public function testSetObjectName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::setTagName
     * @todo   Implement testSetTagName().
     */
    public function testSetTagName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::getTagName
     * @todo   Implement testGetTagName().
     */
    public function testGetTagName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::setTagType
     */
    public function testSetTagType()
    {
        $this->object->setTagType('test');
        $this->assertEquals('test', $this->object->tagType);
    }

    /**
     * @covers EaseHtmlTag::getTagType
     * @depends testSetTagType
     */
    public function testGetTagType()
    {
        $this->assertEquals('test', $this->object->getTagType());
    }

    /**
     * @covers EaseHtmlTag::setTagClass
     * @todo   Implement testSetTagClass().
     */
    public function testSetTagClass()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::addTagClass
     * @todo   Implement testAddTagClass().
     */
    public function testAddTagClass()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::getTagClass
     * @todo   Implement testGetTagClass().
     */
    public function testGetTagClass()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::setTagID
     */
    public function testSetTagID()
    {
        $this->object->setTagID();
        $this->assertNotEmpty($this->object->getTagProperty('id'));
        $this->object->setTagID('testid');
        $this->assertEquals('testid', $this->object->getTagProperty('id'));
    }

    /**
     * @covers EaseHtmlTag::getTagID
     * @depends testSetTagID
     */
    public function testGetTagID()
    {
        $this->object->setTagID('testid2');
        $this->assertEquals('testid2', $this->object->getTagProperty('id'));
    }

    /**
     * @covers EaseHtmlTag::getTagProperty
     * @todo   Implement testGetTagProperty().
     */
    public function testGetTagProperty()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::setTagProperties
     * @todo   Implement testSetTagProperties().
     */
    public function testSetTagProperties()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::tagPropertiesToString
     * @todo   Implement testTagPropertiesToString().
     */
    public function testTagPropertiesToString()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::setTagCss
     * @todo   Implement testSetTagCss().
     */
    public function testSetTagCss()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::cssPropertiesToString
     * @todo   Implement testCssPropertiesToString().
     */
    public function testCssPropertiesToString()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers EaseHtmlTag::draw
     * @todo   Implement testDraw().
     */
    public function testDraw()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

}
