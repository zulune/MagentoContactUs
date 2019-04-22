<?php

namespace MaxCage\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;
use MaxCage\ContactUs\Api\Data\ContactUsInterface;

class ContactUs extends AbstractModel implements ContactUsInterface
{
    protected function _construct()
    {
        $this->_init(\MaxCage\ContactUs\Model\ResourceModel\ContactUs::class);
    }

    public function getId()
    {
        return $this->getData(ContactUsInterface::ENTITY_ID);
    }

    public function getName()
    {
        return $this->getData(ContactUsInterface::NAME);
    }

    public function getTelephone()
    {
        return $this->getData(ContactUsInterface::TELEPHONE);
    }

    public function getEmail()
    {
        return $this->getData(ContactUsInterface::EMAIL);
    }

    public function getMessage()
    {
        return $this->getData(ContactUsInterface::MESSAGE);
    }

    public function getCreationTime()
    {
        return $this->getData(ContactUsInterface::CREATION_TIME);
    }

    public function getStatus()
    {
        return $this->getData(ContactUsInterface::STATUS);
    }

    public function setId($id)
    {
        return $this->setData(ContactUsInterface::ENTITY_ID, $id);
    }

    public function setName($name)
    {
        return $this->setData(ContactUsInterface::NAME, $name);
    }

    public function setTelephone($telephone)
    {
        return $this->setData(ContactUsInterface::TELEPHONE, $telephone);
    }

    public function setEmail($email)
    {
        return $this->setData(ContactUsInterface::EMAIL, $email);
    }

    public function setMessage($message)
    {
        return $this->setData(ContactUsInterface::MESSAGE, $message);
    }

    public function setCreationTime($creation_time)
    {
        return $this->setData(ContactUsInterface::CREATION_TIME, $creation_time);
    }

    public function setStatus($status)
    {
        return $this->setData(ContactUsInterface::STATUS, $status);
    }
}
