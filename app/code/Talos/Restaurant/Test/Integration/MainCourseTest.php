<?php
namespace Talos\Restaurant\Model;

class MainCourseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Talos\Restaurant\Model\MainCourse
     */
    protected $mainCourse;

    protected function setUp()
    {
        $this->mainCourse = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\MainCourse'
        );
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     */
    public function testCRUD()
    {
        $this->mainCourse->setPrice(
            200
        )->setName(
            'MainCourse'
        )->setDescription(
            'Test main course'
        );
        $crud = new \Magento\TestFramework\Entity($this->mainCourse, ['name' => 'Different main course name']);
        $crud->testCrud();
    }
}