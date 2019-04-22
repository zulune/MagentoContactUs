<?php
namespace MaxCage\ContactUs\Block\Adminhtml\ContactUs\Edit;

use Magento\Backend\Block\Widget\Context;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ContactUsInterfaceFactory
     */
    protected $contactUsFactory;

    /**
     * @param Context $context
     * @param ContactUsInterfaceFactory $blockRepository
     */
    public function __construct(
        Context $context,
        ContactUsInterfaceFactory $contactUsFactory
    ) {
        $this->context = $context;
        $this->contactUsFactory = $contactUsFactory;
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getContactId()
    {
        try {
            return $this->contactUsFactory->create()->load(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}