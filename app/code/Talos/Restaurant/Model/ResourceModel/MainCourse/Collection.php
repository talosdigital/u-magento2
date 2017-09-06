<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 10:53 AM
 */

namespace Talos\Restaurant\Model\ResourceModel\MainCourse;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Talos\Restaurant\Model\MainCourse', 'Talos\Restaurant\Model\ResourceModel\MainCourse');
    }
}