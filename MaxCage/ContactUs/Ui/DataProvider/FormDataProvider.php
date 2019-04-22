<?php
/**
 * Copyright :copyright: Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MaxCage\ContactUs\Ui\DataProvider;

use MaxCage\ContactUs\Model\ResourceModel\ContactUs\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class FormDataProvider
 */
class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \MaxCage\ContactUs\Model\ResourceModel\ContactUs $item */
        foreach ($items as $message) {
            $this->loadedData[$message->getData('entity_id')] = $message->getData();
        }

        $data = $this->dataPersistor->get('contact_us_store');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getData('entity_id')] = $block->getData();
            $this->dataPersistor->clear('contact_us_store');
        }

        return $this->loadedData;
    }
}