<?php
namespace MaxCage\ContactUs\Controller\Adminhtml\Contacts;

use Magento\Framework\App\Action\HttpPostActionInterface;
use MaxCage\ContactUs\Controller\Adminhtml\Contacts;

class Save extends Contacts implements HttpPostActionInterface
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            /** @var \MaxCage\ContactUs\Model\ContactUs $model */
            $model = $this->contactUsFactory->create();

            $id = $this->getRequest()->getParam('entity_id');

            if ($id) {
                $model->load($id);
            }
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Customer message saved'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back')) {

                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('WOW! Something went wrong while saving the tab'));
            }
            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
