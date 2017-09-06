<?php

$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

/** @var $mainCourse \Talos\Restaurant\Model\MainCourse */
$mainCourse = $objectManager->create('Talos\Restaurant\Model\MainCourse');
$mainCourse->setPrice(
    100
)->setName(
    'MainCourseTest'
)->setDescription(
    'Test of main course'
)->save();
