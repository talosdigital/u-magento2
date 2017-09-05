<?php
namespace Talos\CrossSellPage\Controller\Ajax;

class UpdateCart extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultJsonFactory;

    protected $cart;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactoryPageFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Checkout\Model\Cart $cart
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->cart = $cart;
        parent::__construct($context);
    }


    public function execute()
    {
        // We need to return the cart block
        $cartBlock = $this->_view->getLayout()->createBlock('Magento\Checkout\Block\Cart');
        $cart = $cartBlock->toHtml();
        $json = $this->resultJsonFactory->create();
        return $json->setData([$cart]);
    }
}
