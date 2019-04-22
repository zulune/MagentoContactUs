<?php
namespace MaxCage\ContactUs\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use MaxCage\ContactUs\Model\MessageStatus as MessageStatusModel;
/**
 * Class DepartmentActions
 */
class MessageStatus extends Column
{
    /**
     * @var MessageStatusModel
     */
    protected $messageStatus;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        MessageStatusModel $messageStatus,
        array $components = [],
        array $data = []
    ) {
        $this->messageStatus = $messageStatus;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $options = $this->messageStatus->getOptionArray();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = $options[$item[$this->getData('name')]]->getText();
            }
        }

        return $dataSource;
    }
}