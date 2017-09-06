<?php

/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 11:18 AM
 */

namespace Talos\Restaurant\Model\ResourceModel\Appetizer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Talos\Restaurant\Model\Appetizer', 'Talos\Restaurant\Model\ResourceModel\Appetizer');
    }
}