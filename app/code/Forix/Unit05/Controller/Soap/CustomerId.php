<?php

namespace Forix\Unit05\Controller\Soap;

use Magento\Framework\App\Action\Action;

class CustomerId extends Action
{

    public function execute()
    {
        $wsdlUrl = 'https://freshmagento.local/soap/all?wsdl&services=catalogProductRepositoryV1';

        $options = [
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ])
        ];

        $soapClient = new \SoapClient($wsdlUrl, $options);

        $searchCriteria = [
            'filter_groups' => [
                [
                    'filters' => [
                        [
                            'field' => 'status',
                            'value' => '1',
                            'condition_type' => 'eq'
                        ]
                    ]
                ]
            ],
            'sort_orders' => [
                [
                    'field' => 'name',
                    'direction' => 'ASC'
                ]
            ],
            'page_size' => 10,
            'current_page' => 1
        ];

        try {
            $result = $soapClient->catalogProductRepositoryV1GetList(['searchCriteria' => $searchCriteria]);
            print_r($result);
        } catch (\SoapFault $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
