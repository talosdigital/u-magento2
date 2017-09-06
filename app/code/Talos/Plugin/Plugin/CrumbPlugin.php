<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 5/22/17
 * Time: 10:17 AM
 */

namespace Talos\Plugin\Plugin;

use Magento\Theme\Block\Html\Breadcrumbs;

class CrumbPlugin
{
    /**
     * Updates the name of the breadcrumb but not the label
     *
     * @param Breadcrumbs $subject
     * @param $crumbName
     * @param $crumbInfo
     * @return array
     */
    public function beforeAddCrumb(Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
        return [$crumbName . '(!)', $crumbInfo];
    }
}