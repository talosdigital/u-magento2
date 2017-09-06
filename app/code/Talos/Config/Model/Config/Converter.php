<?php
namespace Talos\Config\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{
    /**
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $output = [];
        foreach ($source->getElementsByTagName('node') as $node) {
            $output[] = $node->textContent;
        }

        return $output;
    }
}