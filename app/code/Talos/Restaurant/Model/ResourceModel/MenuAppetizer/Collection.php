<?php

namespace Talos\Restaurant\Model\ResourceModel\MenuAppetizer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends  AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Talos\Restaurant\Model\MenuAppetizer', 'Talos\Restaurant\Model\ResourceModel\MenuAppetizer');
    }
}