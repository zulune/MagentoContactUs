<?php
namespace MaxCage\ContactUs\Controller\Adminhtml\Contacts;

use MaxCage\ContactUs\Controller\Adminhtml\Contacts;
use MaxCage\ContactUs\Model\ContactUs;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\Model\View\Result\Redirect;

class Delete extends Contacts
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id');

        if ($id) {
            try {
                /** @var ContactUs $model */
                $model = $this->contactUsFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the customer message.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a customer message to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
