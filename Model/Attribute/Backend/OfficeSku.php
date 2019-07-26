<?php
/**
 * Created by PhpStorm.
 * User: syedzaidi
 * Date: 7/23/19
 * Time: 12:00 AM
 */

namespace Syedzaidi\CustomAttrCustomer\Model\Attribute\Backend;


use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class OfficeSku extends AbstractBackend
{
    /**
     * @param \Magento\Catalog\Model\Product $object
     * @return bool
     * @throws LocalizedException
     */
    public function validate($object)
    {
       $value = $object->getData($this->getAttribute()->getAttributeCode());

       if ($value == 'sale') {

           throw new LocalizedException(__('Sale related sku not allowed'));
       }
       return true;

    }
}