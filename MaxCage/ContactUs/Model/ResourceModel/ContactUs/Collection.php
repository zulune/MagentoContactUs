<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MaxCage\ContactUs\Model\ResourceModel\ContactUs;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MaxCage\ContactUs\Api\Data\ContactUsInterface;

/**
 * Contact Us Resource model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = ContactUsInterface::ENTITY_ID;
    protected $_eventPrefix = ContactUsInterface::ENTITY_ID . '_collection';
    protected $_eventObject = ContactUsInterface::ENTITY_ID . '_collection';

    protected function _construct()
    {
        parent::_init(
            \MaxCage\ContactUs\Model\ContactUs::class,
            \MaxCage\ContactUs\Model\ResourceModel\ContactUs::class
        );
    }
}
