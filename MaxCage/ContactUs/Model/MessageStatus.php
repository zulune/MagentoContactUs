<?php

namespace MaxCage\ContactUs\Model;

use Magento\Framework\Data\OptionSourceInterface;

class MessageStatus implements OptionSourceInterface
{

    const NEW_STATUS       = 'new';
    const ANSWERED_STATUS  = 'answered';
    const VIEWED_STATUS    = 'viewed';

    public function getOptionArray()
    {
        $options = [
            self::ANSWERED_STATUS   => __('Answered'),
            self::VIEWED_STATUS     => __('Viewed'),
            self::NEW_STATUS        => __('Not viewed')
        ];

        return $options;
    }

    public function getAllOptions()
    {
        $result = $this->getOptions();
        array_unshift($result, ['value' => '', 'label' => '']);

        return $result;
    }

    public function getOptions()
    {
        $result = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
