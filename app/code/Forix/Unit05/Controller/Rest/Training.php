<?php

namespace Forix\Unit05\Controller\Rest;

use Magento\Framework\App\Action\Context;
use function _PHPStan_b8e553790\RingCentral\Psr7\build_query;

class Training extends \Magento\Framework\App\Action\Action
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

    public function execute()
    {
        $apiUrl = $this->_generateApiUrl();
        $token = $this->getRequest()->getParam('token');
        $context = stream_context_create([
            'http' => [
                'header' => "Authorization: Bearer " . $token,
                'method' => 'GET',
            ],
        ]);
        $response = file_get_contents($apiUrl, false, $context);

        if ($response === false) {
            echo "Error: Failed to retrieve API response.";
        } else {
            $this->getResponse()->setHeader('Content-Type', 'application/json', true);
            $this->getResponse()->appendBody($response);
        }
    }

    private function _generateApiUrl()
    {
        $store = $this->storeManager->getStore();
        $storeCode = $store->getCode();
        $baseUrl = $store->getBaseUrl();

        $apiUrl = rtrim($baseUrl, '/') . '/rest/' . $storeCode . '/V1/training-repository?searchCriteria[filterGroups][0][filters][0][field]=name&searchCriteria[filterGroups][0][filters][0][value]=Ba%&searchCriteria[filterGroups][0][filters][0][conditionType]=like&searchCriteria[sortOrders][0][field]=name&searchCriteria[sortOrders][0][direction]=asc&searchCriteria[pageSize]=10&searchCriteria[currentPage]=1';
        return $apiUrl;
    }
}
