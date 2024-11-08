<?php
namespace Akash\EncryptDecryptUrlParam\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;
    /**
     * @var \Akash\EncryptDecryptUrlParam\Helper\Data
     */
    protected $demoHelper;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    protected $_storeManager;


    /**
     * @param Context $context
     * @param \Akash\EncryptDecryptUrlParam\Helper\Data $demoHelper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Context $context,
        \Akash\EncryptDecryptUrlParam\Helper\Data $demoHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
    ) {
        $this->demoHelper   = $demoHelper;
        $this->_storeManager = $storeManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Index Controller Execute Method
     *
     * @return \Magento\Framework\Controller\Result\Redirect|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $userId = "10";
        $id = $this->demoHelper->encryptString($userId);

        $encryptedId = $this->demoHelper->encodeUrl($id);

        $redirectionUrl = "";
        $baseUrl = $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
        $redirectionUrl = $baseUrl."demo/index/getParams/id/".$encryptedId;

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($redirectionUrl);
        return $resultRedirect;
    }
}
