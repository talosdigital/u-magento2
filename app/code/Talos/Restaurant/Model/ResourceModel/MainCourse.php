<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 10:50 AM
 */

namespace Talos\Restaurant\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MainCourse extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('talos_restaurant_main_course', 'id');
    }
}