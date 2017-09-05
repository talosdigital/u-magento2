<?php

/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/7/17
 * Time: 4:16 PM
 */

namespace Talos\CrossSellPage\Block;

use Magento\Framework\Registry;

class View extends \Magento\Framework\View\Element\Template
{
    protected $checkoutSession;
    protected $cart;

    protected $helper;

    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Magento\Checkout\Model\Session $checkoutSession,
      \Magento\Checkout\Model\Cart $cart,
      \Talos\CrossSellPage\Helper\Data $helper,
      array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->cart = $cart;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    public function getProductId()
    {
        return $this->checkoutSession->getProductId();
    }

    public function getProductOptions()
    {
        return $this->helper->getProductOptions($this->getProductId());
    }

    public function getCrossSellProducts()
    {
        return $this->helper->getCrossSellProducts($this->getProductId());
    }
}
