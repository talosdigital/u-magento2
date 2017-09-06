<?php
namespace Talos\Restaurant\Model;

class MenuAppetizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Talos\Restaurant\Model\MenuAppetizer
     */
    protected $menuAppetizer;

    /**
     * @var \Talos\Restaurant\Model\ResourceModel\Menu\CollectionFactory
     */
    protected $menuCollectionFactory;

    /**
     * @var \Talos\Restaurant\Model\ResourceModel\Appetizer\CollectionFactory
     */
    protected $appetizerCollectionFactory;

    protected function setUp()
    {
        $this->menuAppetizer = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\MenuAppetizer'
        );
        $this->menuCollectionFactory = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\ResourceModel\Menu\CollectionFactory'
        );
        $this->appetizerCollectionFactory = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\ResourceModel\Appetizer\CollectionFactory'
        );
    }

    public static function loadFixture()
    {
        include __DIR__ . '/_files/menu_appetizer.php';
    }

    /**
     * @magentoDataFixture loadFixture
     * @magentoAppIsolation enabled
     */
    public function testCRUD()
    {
        $menu = $this->menuCollectionFactory->create()->addFieldToFilter('name', 'Menu1')->getFirstItem();
        $menu2 = $this->menuCollectionFactory->create()->addFieldToFilter('name', 'Menu2')->getFirstItem();
        $appetizer = $this->appetizerCollectionFactory->create()->addFieldToFilter('name', 'AppetizerTest')->getFirstItem();

        $this->menuAppetizer->setMenuId(
            $menu->getId()
        )->setAppetizerId(
            $appetizer->getId()
        );
        $crud = new \Magento\TestFramework\Entity($this->menuAppetizer, ['menu_id' => $menu2->getId()]);
        $crud->testCrud();
    }
}