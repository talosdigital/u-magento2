<?php

namespace Talos\Plugin\Plugin;

/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 5/22/17
 * Time: 9:28 AM
 */
class FooterPlugin
{
    /**
     * Replaces the copyright text at the bottom of the page
     *
     * @param $proceed
     * @return string
     */
    public function aroundGetCopyright($proceed)
    {
        return 'Custom Talos copyright text';
    }
}