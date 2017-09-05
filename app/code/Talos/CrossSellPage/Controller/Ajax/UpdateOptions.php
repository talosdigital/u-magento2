<?php
namespace Talos\CrossSellPage\Controller\Ajax;

class UpdateOptions extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultJsonFactory;

    protected $cart;

    protected $_checkoutSession;

    protected $helper;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactoryPageFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Talos\CrossSellPage\Helper\Data $helper
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->cart = $cart;
        $this->_checkoutSession = $checkoutSession;
        $this->helper = $helper;

        parent::__construct($context);
    }


    public function execute()
    {
        $item = $this->helper->getItemByProductId($this->getRequest()->getParam('id'));
        $id = $item->getItemId();
        $params = $this->getRequest()->getParams();

        $items = $this->cart->getItems();

        if (!isset($params['options'])) {
            $params['options'] = [];
        }
        try {
            if (isset($params['qty'])) {
                $filter = new \Zend_Filter_LocalizedToNormalized(
                    ['locale' => $this->_objectManager->get('Magento\Framework\Locale\ResolverInterface')->getLocale()]
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $quoteItem = $this->cart->getQuote()->getItemById($id);
            if (!$quoteItem) {
                throw new \Magento\Framework\Exception\LocalizedException(__('We can\'t find the quote item.'));
            }

            $item = $this->cart->updateItem($id, new \Magento\Framework\DataObject($params));
            if (is_string($item)) {
                throw new \Magento\Framework\Exception\LocalizedException(__($item));
            }
            if ($item->getHasError()) {
                throw new \Magento\Framework\Exception\LocalizedException(__($item->getMessage()));
            }

            $this->cart->save();

            $this->_eventManager->dispatch(
                'checkout_cart_update_item_complete',
                ['item' => $item, 'request' => $this->getRequest(), 'response' => $this->getResponse()]
            );

            if (!$this->cart->getQuote()->getHasError()) {
                $message = __(
                    '%1 was updated in your shopping cart.',
                    $this->_objectManager->get('Magento\Framework\Escaper')
                        ->escapeHtml($item->getProduct()->getName())
                );
                $this->messageManager->addSuccess($message);
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($this->_checkoutSession->getUseNotice(true)) {
                $this->messageManager->addNotice($e->getMessage());
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->messageManager->addError($message);
                }
            }

            $url = $this->_checkoutSession->getRedirectUrl(true);
            if ($url) {
            } else {
                $cartUrl = $this->_objectManager->get('Magento\Checkout\Helper\Cart')->getCartUrl();
            }
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t update the item right now.'));
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
        }

        $json = $this->resultJsonFactory->create();
        return $json->setData('success');
    }
}
