<?php

namespace Training\Plugins\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\ActionFlag;
use Magento\Customer\Model\Session;

class Redirect implements ObserverInterface
{
    /**
     * @var RedirectInterface
     */
    private $redirect;

    /**
     * @var ActionFlag
     */
    private $flag;

    /**
     * @var Session
     */
    private $session;

    /**
     * Redirect constructor.
     * @param RedirectInterface $redirect
     * @param ActionFlag $flag
     * @param Session $session
     */
    public function __construct(
        RedirectInterface $redirect,
        ActionFlag $flag,
        Session $session
    ) {
        $this->redirect = $redirect;
        $this->flag = $flag;
        $this->session = $session;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getData('request');

        if (!$this->session->isLoggedIn() && $request->getFullActionName() == 'catalog_product_view') {
            $controller = $observer->getEvent()->getData('controller_action');
            $this->flag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }
    }
}
