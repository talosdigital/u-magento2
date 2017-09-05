<?php
/**
 * Created by PhpStorm.
 * User: Carlos Arango
 * Date: 5/05/17
 * Time: 11:29 AM
 */
namespace Talos\CrossSellPage\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;


class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetup
     */
    protected $eavSetup;

    /**
     * UpgradeData constructor.
     * @param EavSetup $eavSetup
     */
    public function __construct(EavSetup $eavSetup)
    {
        $this->eavSetup = $eavSetup;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->showCrossSellPage();
        $setup->endSetup();
    }

    /**
     * Adds a display where to buy link attribute to the products
     */
    public function showCrossSellPage()
    {
        $this->eavSetup->addAttribute(Product::ENTITY, 'show_cross_sell_page', [
            'label'            => 'Show Cross Sell Page',
            'type'             => 'int',
            'input'            => 'select',
            'source'           => Boolean::class,
            'backend'          => ArrayBackend::class,
            'required'         => false,
            'is_used_in_grid'  => true,
            'global'           => ScopedAttributeInterface::SCOPE_WEBSITE,
            'group'            => 'Product Details',
            'visible'          => true,
            'default'          => '0',
            'visible_on_front' => false
        ]);
    }
}