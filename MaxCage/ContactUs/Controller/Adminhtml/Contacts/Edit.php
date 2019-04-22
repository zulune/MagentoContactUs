<?php
namespace MaxCage\ContactUs\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use MaxCage\ContactUs\Controller\Adminhtml\Contacts;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Contacts
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ContactUsInterfaceFactory $contactUsFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ContactUsInterfaceFactory $contactUsFactory,
        PageFactory $resultPageFactory
    ) {
        parent::__construct(
            $context,
            $coreRegistry,
            $contactUsFactory
        );
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->contactUsFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This message does not exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('contact_us_store', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MaxCage_ContactUs::contactus');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Us Customers'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? __('Edit Message') : __('New Message'));

        return $resultPage;
    }
}
