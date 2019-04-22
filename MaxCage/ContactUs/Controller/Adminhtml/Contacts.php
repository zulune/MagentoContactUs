<?php
namespace MaxCage\ContactUs\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use Magento\Backend\Model\View\Result\Page;

abstract class Contacts extends Action
{
    /**
     * @var ContactUsInterfaceFactory
     */
    protected $contactUsFactory;

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MaxCage_ContactUs::contact_us';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context  $context,
        Registry $coreRegistry,
        ContactUsInterfaceFactory   $contactUsFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry    =   $coreRegistry;
        $this->contactUsFactory =   $contactUsFactory;
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('MaxCage_ContactUs::contactus')
            ->addBreadcrumb(__('Customers'), __('Customers'));

        return $resultPage;
    }
}
