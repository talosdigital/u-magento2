<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 2:17 PM
 */

namespace Talos\Restaurant\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Menu extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('talos_restaurant_menu', 'id');
    }
}