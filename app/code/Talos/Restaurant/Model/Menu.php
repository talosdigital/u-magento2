<?php
/**
 * Created by PhpStorm.
 * User: carlosarango
 * Date: 3/17/17
 * Time: 1:56 PM
 */

namespace Talos\Restaurant\Model;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\Context;
use \Magento\Framework\Registry;
use Talos\Restaurant\Model\ResourceModel\Menu as ResourceModel;
use Talos\Restaurant\Model\ResourceModel\Menu\Collection;

class Menu extends AbstractExtensibleModel
{
    /**
     * Menu constructor.
     * Model's are in charge of manipulating the data that comes from the db, but they don't access it directly.
     * In order to intialize our model, we need to pass to the constructor, both the resource model and the collection.
     *
     * @param Context $context
     * @param Registry $registry
     * @param ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param ResourceModel $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        ResourceModel $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $resource,
            $resourceCollection,
            $data
        );
    }

    protected function getCustomAttributesCodes()
    {
        return ['id', 'name', 'main_course_id'];
    }
}