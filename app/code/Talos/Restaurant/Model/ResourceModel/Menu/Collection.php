<?php

namespace Talos\Restaurant\Model\ResourceModel\Menu;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Talos\Restaurant\Model\Menu', 'Talos\Restaurant\Model\ResourceModel\Menu');
    }
}