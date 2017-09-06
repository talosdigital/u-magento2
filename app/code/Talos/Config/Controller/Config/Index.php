<?php
namespace Talos\Config\Controller\Config;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Talos\Config\Model\Config\ConfigInterface;

class Index extends Action
{
    protected $config;

    public function __construct(Context $context, ConfigInterface $config)
    {
        parent::__construct($context);
        $this->config = $config;
    }

    public function execute()
    {
        $nodes = [];
        $nodes = $this->config->getConfigData();
        if (is_array($nodes)){
            foreach ($nodes as $node) {
                $this->getResponse()->appendBody($node . ' - ');
            }
        }
    }
}