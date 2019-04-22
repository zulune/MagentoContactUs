<?php
namespace MaxCage\ContactUs\Block\Adminhtml\ContactUs\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ReplyButton
 */
class ReplyButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reply'),
            'on_click' => sprintf("location.href = '%s';", $this->getReplyUrl()),
            'class' => 'save',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    private function getReplyUrl()
    {
        return $this->getUrl('*/*/reply', ['id' => (int)$this->context->getRequest()->getParam('id')]);
    }
}
