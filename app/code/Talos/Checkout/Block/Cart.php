<?php
namespace Talos\Checkout\Block;

/**
 * Shopping cart block
 */
class Cart extends \Magento\Checkout\Block\Cart
{

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Model\ResourceModel\Url $catalogUrlBuilder,
        \Magento\Checkout\Helper\Cart $cartHelper,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data)
    {
        parent::__construct($context, $customerSession, $checkoutSession, $catalogUrlBuilder, $cartHelper, $httpContext, $data);
    }

    protected function _toHtml()
    {
        $this->setModuleName($this->extractModuleName('Magento\Checkout\Block\Cart'));
        return parent::_toHtml();
    }
}