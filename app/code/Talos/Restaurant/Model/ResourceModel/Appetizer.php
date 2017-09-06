<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 11:18 AM
 */

namespace Talos\Restaurant\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Appetizer extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('talos_restaurant_appetizer', 'id');
    }
}