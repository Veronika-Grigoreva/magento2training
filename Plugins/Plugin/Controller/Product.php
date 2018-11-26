<?php

namespace Training\Plugins\Plugin\Controller;

use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\RedirectFactory;

class Product
{
    /**
     * @var Session
     */
    private $customSession;

    /**
     * @var RedirectFactory
     */
    private $factory;

    /**
     * Product constructor.
     * @param Session $customSession
     * @param RedirectFactory $factory
     */
    public function __construct(
        Session $customSession,
        RedirectFactory $factory
    ) {
        $this->customSession = $customSession;
        $this->factory = $factory;
    }

    public function aroundExecute(\Magento\Catalog\Controller\Product\View $subject, \Closure $proceed) {
        if (!$this->customSession->isLoggedIn()) {
            return $this->factory->create()->setPath('customer/account/login');
        }

        return $proceed();
    }
}
