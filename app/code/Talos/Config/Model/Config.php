<?php

namespace Talos\Config\Model;

use Magento\Framework\Config\CacheInterface;
use Talos\Config\Model\Config\Reader;
use Talos\Config\Model\Config\ConfigInterface;
use Magento\Framework\Config\Data;

class Config extends Data implements ConfigInterface
{
    public function __construct(Reader $reader, CacheInterface $cache, $cacheId="talos_config1")
    {
        parent::__construct($reader, $cache, $cacheId);
    }

    public function getConfigData()
    {
        return $this->get();
    }
}