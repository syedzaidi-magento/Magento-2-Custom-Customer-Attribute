<?php

namespace Syedzaidi\CustomAttrCustomer\Setup;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{


    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * InstallData constructor.
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(CustomerSetupFactory $customerSetupFactory)
    {

        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create();
        $customerSetup->addAttribute(Customer::ENTITY, 'calling_code', [
            'group' => 'General',
            'type' => 'varchar',
            'label' => 'Calling Code',
            'input' => 'text',
            'source' => '',
            'frontend' => 'Syedzaidi\CustomAttrCustomer\Model\Attribute\Frontend\OfficeSku',
            'backend' => 'Syedzaidi\CustomAttrCustomer\Model\Attribute\Backend\OfficeSku',
            'required' => false,
            'position' => 500,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'visible' => true,
            'is_html_allowed_on_front' => true,
            'visible_on_front' => true,
            'system' => false,
            'is_user_defined' => 1,
        ]);

        try {
            $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'calling_code')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]
                ]);
            $attribute->save();
        } catch (LocalizedException $e) {
        }


    }
}