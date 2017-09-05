<?php

/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 6/23/17
 * Time: 10:55 AM
 */
namespace Talos\CrossSellPage\Observer;

use Magento\Framework\Event\ObserverInterface;
use Talos\CrossSellPage\Helper\Data;
use Magento\Framework\UrlInterface;
use Magento\Checkout\Model\Session;


class CartAfterAddProduct implements  ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    protected $crossSellHelper;

    /**
     * CartAfterAddProduct constructor.
     * @param UrlInterface $url
     * @param Session $checkoutSession
     * @param Data $crossSellHelper
     */
    function __construct(
        UrlInterface $url,
        Session $checkoutSession,
        Data $crossSellHelper
    ) {
        $this->url = $url;
        $this->checkoutSession = $checkoutSession;
        $this->crossSellHelper = $crossSellHelper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();

        if ($this->crossSellHelper->showCrossSellPage($product)) {
            $this->checkoutSession->setProductId($product->getId());
            $customUrl = $this->url->getUrl('crosssellpage');
            $observer->getRequest()->setParam('return_url', $customUrl);
        }
    }
}