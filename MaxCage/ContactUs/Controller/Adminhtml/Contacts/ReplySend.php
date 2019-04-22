<?php
namespace MaxCage\ContactUs\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use MaxCage\ContactUs\Api\Data\ContactUsInterfaceFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Magento\Email\Model\Template\Config;
use Magento\Store\Model\Store;
use Magento\Framework\App\Area;
use Magento\Framework\View\Result\PageFactory;
use MaxCage\ContactUs\Controller\Adminhtml\Contacts;

class ReplySend extends Contacts
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ScopeConfigInterface;
     */
    protected $scopeConfig;

    /**
     * @var TransportBuilder;
     */
    protected $transportBuilder;

    /**
     * @var LoggerInterface;
     */
    protected $logger;

    /**
     * @var Config
     */
    protected $emailConfig;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ContactUsInterfaceFactory $contactUsFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param PageFactory $resultPageFactory
     * @param TransportBuilder $transportBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ContactUsInterfaceFactory $contactUsFactory,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory,
        TransportBuilder $transportBuilder,
        LoggerInterface $logger
    ) {
        parent::__construct(
            $context,
            $coreRegistry,
            $contactUsFactory
        );
        $this->scopeConfig = $scopeConfig;
        $this->resultPageFactory = $resultPageFactory;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $formData = $this->getRequest()->getPost();

        $id = $formData['id'];

        $adminName = $this->scopeConfig->getValue('trans_email/ident_support/name', ScopeInterface::SCOPE_STORE);
        $adminEmail = $this->scopeConfig->getValue('trans_email/ident_support/email', ScopeInterface::SCOPE_STORE);
        $sender = ['name' => $adminName, 'email' => $adminEmail];
        $recipientName = $formData['name'];
        $recipientEmail = $formData['email'];

        $emailData = [
            'name' => $adminName,
            'email' => $adminEmail,
            'telephone' => '',
            'comment' => $formData['reply_message']
        ];

        try {
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('enquiry_answer_template')
                ->setTemplateOptions([
                    'area' => Area::AREA_ADMINHTML,
                    'store' => Store::DEFAULT_STORE_ID
                ])
                ->setTemplateVars([
                    'data' => $emailData
                ])
                ->setFrom($sender)
                ->addTo($recipientEmail, $recipientName)
                ->getTransport();

            $transport->sendMessage();

            $this->messageManager->addSuccess(__(sprintf('Reply send to customer %s successfully!', $formData['email'])));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $this->logger->debug($e->getMessage());
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
    }
}