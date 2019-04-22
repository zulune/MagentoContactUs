<?php

namespace MaxCage\ContactUs\Plugin;

use MaxCage\ContactUs\Api\Data\ContactUsInterface;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use MaxCage\ContactUs\Model\MessageStatus;

class Post
{
    /**
     * @var ContactUsInterfaceFactory
     */
    protected $contactUsFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        DataPersistorInterface $dataPersistor,
        ContactUsInterfaceFactory $contactUsFactory
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->contactUsFactory = $contactUsFactory;
    }

    public function afterExecute(\Magento\Contact\Controller\Index\Post $subject, $result)
    {
        if (!$this->dataPersistor->get('contact_us') && count($formData = $subject->getRequest()->getParams()) > 0) {
            /** @var ContactUsInterface $contactUs */
            $contactUs = $this->contactUsFactory->create();
            $contactUs
                ->setData(ContactUsInterface::NAME,         $formData['name'])
                ->setData(ContactUsInterface::TELEPHONE,    $formData['telephone'])
                ->setData(ContactUsInterface::EMAIL,        $formData['email'])
                ->setData(ContactUsInterface::MESSAGE,      $formData['comment'])
                ->setData(ContactUsInterface::CREATION_TIME, date('Y-m-d H:i:s'))
                ->setData(ContactUsInterface::STATUS,       MessageStatus::NEW_STATUS)
                ->save();
        }

        return $result;
    }
}