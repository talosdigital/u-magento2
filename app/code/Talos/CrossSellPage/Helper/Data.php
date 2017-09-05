<?php
namespace Talos\CrossSellPage\Helper;

use \Magento\Catalog\Model\ProductRepository;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const SHOW_CROSS_SELL_PAGE_ATTRIBUTE = 'show_cross_sell_page';

    protected $productRepository;

    protected $cart;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Checkout\Model\Cart $cart,
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        parent::__construct($context);
    }

    /**
     * Returns true if product has the show cross sell page set to yes
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return bool
     */
    public function showCrossSellPage(\Magento\Catalog\Model\Product $product)
    {
        if ($product->getData($this::SHOW_CROSS_SELL_PAGE_ATTRIBUTE) == '1') {
            return true;
        }
        return false;
    }

    /**
     * @param $productId
     * @return \Magento\Catalog\Api\Data\ProductCustomOptionInterface[]|null
     */
    public function getProductOptions($productId)
    {
        $product = $this->productRepository->getById($productId);
        return $product->getOptions();
    }

    /**
     * @param $productId
     * @return bool
     */
    public function getItemByProductId($productId)
    {
        $resultItem  = null;
        $items = $this->cart->getItems();

        foreach ($items as $item) {
            $itemId = $item->getProductId();
            if ($itemId ==  $productId) {
                $resultItem = $item;
            }
        }
        return $resultItem;
    }

    public function getSelectedOptionId($item, $optionId)
    {
        $selectedOptionId = '';
        $options = $item->getOptions();
        foreach ($options as $option) {
            $value = is_object($option->getValue()) ? @unserialize($option->getValue()) : false;
            if ($value && array_key_exists($optionId, $value['options'])) {
                $selectedOptionId = $value['options'][$optionId];
            }
        }
        return $selectedOptionId;
    }

    public function getCrossSellProducts($productId)
    {
        $product = $this->productRepository->getById($productId);
        $crossSellProducts = [];
        foreach ($product->getCrossSellProducts() as $crossSellProduct) {
            $crossSellProducts[] = $this->productRepository->getById($crossSellProduct->getId());
        }
        return $crossSellProducts;
    }
}