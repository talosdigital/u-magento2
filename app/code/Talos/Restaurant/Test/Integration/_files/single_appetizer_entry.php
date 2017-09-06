<?php

$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

/** @var $appetizer Talos\Restaurant\Model\Appetizer */
$appetizer = $objectManager->create('Talos\Restaurant\Model\Appetizer');
$appetizer->setPrice(
    200
)->setName(
    'AppetizerTest'
)->setDescription(
    'Test of appetizer'
)->save();
