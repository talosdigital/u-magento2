<?php
namespace Talos\Restaurant\Model;

class MenuTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Talos\Restaurant\Model\Menu
     */
    protected $menu;

    /**
     * @var \Talos\Restaurant\Model\ResourceModel\MainCourse\Collection
     */
    protected $mainCourseCollection;

    protected function setUp()
    {
        $this->menu = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\Menu'
        );
        $this->mainCourseCollection = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\ResourceModel\MainCourse\Collection'
        );
    }

    public static function loadFixture()
    {
        include __DIR__ . '/_files/single_main_course_entry.php';
    }

    /**
     * @magentoDataFixture loadFixture
     */
    public function testCRUD()
    {
        $mainCourse = $this->mainCourseCollection->addFieldToFilter('name', 'MainCourseTest')->getFirstItem();

        $this->menu->setName(
            'Menu'
        )->setMainCourseId(
            $mainCourse->getId()
        );

        $crud = new \Magento\TestFramework\Entity($this->menu, ['name' => 'DifferentMenuName']);
        $crud->testCrud();
    }
}