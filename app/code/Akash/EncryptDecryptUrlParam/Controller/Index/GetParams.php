<?php
namespace Akash\EncryptDecryptUrlParam\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;

class GetParams extends Action implements HttpGetActionInterface
{
    /**
     * @var \Akash\EncryptDecryptUrlParam\Helper\Data
     */
    protected $helper;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;
    /**
     * @param Context $context
     * @param \Akash\EncryptDecryptUrlParam\Helper\Data $helper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     */
    public function __construct(
        Context $context,
        \Akash\EncryptDecryptUrlParam\Helper\Data $helper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Controller\ResultFactory $resultFactory
    ) {
        $this->helper        = $helper;
        $this->resultFactory = $resultFactory;
        $this->_storeManager = $storeManager;

        parent::__construct($context);
    }

    /**
     * Execute Method to display the parameter value
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $userIdHash = $this->getRequest()->getParam("id", "");
        $userId = 0;
        if (!empty($userIdHash)) {
            $decryptedHash = $this->helper->decodeUrl($userIdHash);
            $decryptedHash = str_replace(" ", "+", $decryptedHash);
            $userId = (int)$this->helper->decryptString($decryptedHash);
            echo "USER ID:$userId";
            die();
        }
        $resultRedirect = $this->resultFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT
        );
        $redirectionUrl = $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
        $result = $resultRedirect->setUrl($redirectionUrl);
        return $result;
    }
}
