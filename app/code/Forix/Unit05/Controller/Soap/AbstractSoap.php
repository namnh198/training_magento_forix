<?php

namespace Forix\Unit05\Controller\Soap;

use Magento\Framework\App\Action\Context;

abstract class AbstractSoap extends \Magento\Framework\App\Action\Action
{
    protected $storeManager;

    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }
    protected function _generateWsdlUrl($service, $storeCode = null)
    {
        if (! $storeCode) {
            $storeCode = $this->storeManager->getStore()->getCode();
        }

        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        return rtrim($baseUrl, '/') . '/soap/' . $storeCode . '?wsdl=1&services=' . $service;
    }

    protected function _getSoapClient($service, $storeCode = null)
    {
        $token = $this->getRequest()->getParam('token');
        $wsdlUrl = $this->_generateWsdlUrl($service, $storeCode);
        $soapClient = new \Laminas\Soap\Client($wsdlUrl);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
            'http' => [
                'header' => "Authorization: Bearer {$token}"
            ]
        ]);
        $soapClient->setWSDLCache(0);
        $soapClient->setSoapVersion(SOAP_1_2);
        $soapClient->setStreamContext($context);
        return $soapClient;
    }

    protected function outputResult($result)
    {
        $this->getResponse()->setHeader('Content-Type', 'application/json', true);
        $this->getResponse()->appendBody(json_encode($result));
    }
}
