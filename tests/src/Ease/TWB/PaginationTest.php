<?php

namespace Test\Ease\TWB;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:48.
 */
class PaginationTest extends \Test\Ease\Html\UlTagTest
{
    /**
     * @var Pagination
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Ease\TWB\Pagination(3, 2);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testConstructor()
    {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $mock->__construct(3, 2);
        $mock->__construct(2, 0);
    }

    /**
     * @covers Ease\TWB\Pagination::addPage
     *
     * @todo   Implement testAddPage().
     */
    public function testAddPage()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\TWB\Pagination::Draw
     *
     * @param null $whatWant ignored here
     */
    public function testDraw($whatWant = null)
    {
        parent::testDraw('
<ul class="pagination">
<li>
<a href="?page=0">
<span class="glyphicon glyphicon-fast-backward"></span></a></li>
<li>
<a href="?page=1">
<span class="glyphicon glyphicon-chevron-left"></span></a></li>
<li>
<a href="?page=0">1</a></li>
<li>
<a href="?page=1">2</a></li>
<li class="active">
<a href="?page=2">3</a></li>
<li class="disabled">
<a href="?page=#">
<span class="glyphicon glyphicon-chevron-right"></span></a></li>
<li class="disabled">
<a href="?page=#">
<span class="glyphicon glyphicon-fast-forward"></span></a></li></ul>');
    }
}
