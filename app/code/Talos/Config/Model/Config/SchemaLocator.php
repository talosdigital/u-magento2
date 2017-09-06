<?php
namespace Talos\Config\Model\Config;

use Magento\Framework\Config\SchemaLocatorInterface;

class SchemaLocator implements SchemaLocatorInterface
{
    protected $_schema = null;

    protected $_perFileSchema= null;

    /**
     * SchemaLocator constructor.
     * @param Reader $moduleReader
     */
    function __construct(\Magento\Framework\Module\Dir\Reader $moduleReader)
    {
        $etcDir = $moduleReader->getModuleDir('etc', 'Talos_Config');
        $this->_schema = $etcDir . '/customConf.xsd';
        $this->_perFileSchema = $etcDir . '/customConf.xsd';
    }

    public function getSchema()
    {
        return $this->_schema;
    }

    public function getPerFileSchema()
    {
        return $this->_perFileSchema;
    }
}