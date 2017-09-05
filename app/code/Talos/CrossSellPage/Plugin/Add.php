<?php

/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 6/21/17
 * Time: 10:14 AM
 */
namespace Talos\CrossSellPage\Plugin;
use Magento\Framework\ObjectManagerInterface;

class Add
{
    protected $url;
    protected $objectManager;
    protected $redirectFactory;
    protected $checkoutSession;

    function __construct(
        \Magento\Framework\UrlInterface $url,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory,
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        $this->url = $url;
        $this->objectManager = $objectManager;
        $this->redirectFactory = $redirectFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function afterExecute(\Magento\Checkout\Controller\Cart\Add $subject, $result)
    {
        $request = $subject->getRequest();
        $customRedirectionUrl = $this->url->getUrl('crosssellpage');
        $productId = (int)$subject->getRequest()->getParam('product');
        $this->checkoutSession->setProductId($productId);

        if (!$request->isAjax()) {
            $redirect = $this->redirectFactory->create();
            $redirect->setUrl($customRedirectionUrl);
            return $redirect;
        }

        $result = ['backUrl' => $customRedirectionUrl];
        $subject->getResponse()->
            representJson($this->objectManager->get('Magento\Framework\Json\Helper\Data')->jsonEncode($result)
        );
    }
}