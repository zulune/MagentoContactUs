<?php
namespace MaxCage\ContactUs\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use MaxCage\ContactUs\Controller\Adminhtml\Contacts;
use Magento\Framework\View\Result\PageFactory;

class Reply extends Contacts
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ContactUsInterfaceFactory $contactUsFactory,
        PageFactory $pageFactory
    ) {
        parent::__construct(
            $context,
            $coreRegistry,
            $contactUsFactory
        );
        $this->resultPageFactory = $pageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->contactUsFactory->create();

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                $this->messageManager->addError(__('This message doesn\'t exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->_coreRegistry->register('contact_us_store', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MaxCage_ContactUs::contactus');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Us Customers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Message View'));
        $resultPage->getConfig()->getTitle()->prepend(__('Reply'));

        return $resultPage;
    }
}