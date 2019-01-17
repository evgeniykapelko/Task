<?php

namespace Learning\Eav\Controller\Account\Status;

use Magento\Framework\App\ResponseInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;


    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customer;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;


    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Customer\Model\CustomerFactory $customer,
                                \Magento\Customer\Model\Session $customerSession,
                                \Magento\Framework\Controller\ResultFactory $result
                                )
    {
        parent::__construct($context);
        $this->resultPageFactory = $result;
        $this->customer = $customer;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->customer->create()->load($customerId);
        $status = $this->getRequest()->getParam('status');
        $customerData = $customer->getDataModel();
        $customerData->setCustomAttribute('entity_status', $status); //entity_status
        $customer->updateData($customerData);
            $customer->save();
        $resultRedirect = $this->resultPageFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }

}