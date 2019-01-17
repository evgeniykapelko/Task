<?php

namespace Learning\Eav\Plugin\CustomerData;

class Customer
{
    protected $customerSession;

    protected $customerFactory;

    public function __construct(
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->customerFactory = $customerFactory;
        $this->customerSession = $customerSession;
    }

    public function afterGetSectionData(\Magento\Customer\CustomerData\Customer $subject, $result)
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->customerFactory->create()->load($customerId);
        if ($result && $customer->getEntityStatus()) {
            $result['status'] = $customer->getEntityStatus();
        }
        return $result;
    }
}