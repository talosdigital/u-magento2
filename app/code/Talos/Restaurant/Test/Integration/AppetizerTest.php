<?php
namespace Talos\Restaurant\Model;

class AppetizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Talos\Restaurant\Model\Appetizer
     */
    protected $appetizer;

    protected function setUp()
    {
        $this->appetizer = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Talos\Restaurant\Model\Appetizer'
        );
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     */
    public function testCRUD()
    {
        $this->appetizer->setPrice(
            100
        )->setName(
            'TastyAppetizer'
        )->setDescription(
            'Test appetizer'
        );
        $crud = new \Magento\TestFramework\Entity($this->appetizer, ['name' => 'DifferentName']);
        $crud->testCrud();
    }
}