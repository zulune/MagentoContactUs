<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MaxCage\ContactUs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MaxCage\ContactUs\Api\Data\ContactUsInterface;

/**
 * Contact Us Resource model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ContactUs extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('contact_us', ContactUsInterface::ENTITY_ID);
    }
}
