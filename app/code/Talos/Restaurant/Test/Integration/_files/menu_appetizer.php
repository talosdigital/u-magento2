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

/** @var $mainCourse \Talos\Restaurant\Model\MainCourse */
$mainCourse = $objectManager->create('Talos\Restaurant\Model\MainCourse');
$mainCourse->setPrice(
    100
)->setName(
    'MainCourseTest'
)->setDescription(
    'Test of main course'
)->save();

/** @var $menu \Talos\Restaurant\Model\Menu */
$menu = $objectManager->create('Talos\Restaurant\Model\Menu');
$menu->setName(
    'Menu1'
)->setMainCourseId(
    $mainCourse->getId()
)->save();

/** @var $menu2 \Talos\Restaurant\Model\Menu */
$menu2 = $objectManager->create('Talos\Restaurant\Model\Menu');
$menu2->setName(
    'Menu2'
)->setMainCourseId(
    $mainCourse->getId()
)->save();