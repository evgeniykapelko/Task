<?php

namespace Learning\Eav\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class InstallData implements InstallDataInterface
{
    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'entity_status',
            [
                'type'         => 'varchar',
                'label'        => 'Status Attribute',
                'input'        => 'text',
                'required'     => false,
                'system'       => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
            ]
        );

        $customerSetup->updateAttribute('customer', 'entity_status', 'is_used_for_customer_segment', '1');

        $forms = ['adminhtml_customer'];

        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'entity_status');
        $attribute->setData('used_in_forms', ['adminhtml_customer']);

        $attribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1
        ]);
        $attribute->save();
        $setup->endSetup();

    }
}