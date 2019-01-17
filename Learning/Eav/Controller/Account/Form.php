<?php

namespace Learning\Eav\Controller\Account;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Form extends \Magento\Customer\Controller\AbstractAccount
{
    protected $resultPageFactory;

    public function __construct(Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    public function execute()
    {
        return $this->resultPageFactory->create();
    }

}