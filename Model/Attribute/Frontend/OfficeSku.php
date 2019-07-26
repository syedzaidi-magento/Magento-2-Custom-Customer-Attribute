<?php
/**
 * Created by PhpStorm.
 * User: syedzaidi
 * Date: 7/22/19
 * Time: 10:08 PM
 */

namespace Syedzaidi\CustomAttrCustomer\Model\Attribute\Frontend;


use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class OfficeSku extends AbstractFrontend
{
    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode(), null);
        return "<strong>$value</strong>";
    }
}