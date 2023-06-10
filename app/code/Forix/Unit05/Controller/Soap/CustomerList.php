<?php

namespace Forix\Unit05\Controller\Soap;

class CustomerList extends AbstractSoap
{

    public function execute()
    {
        try {
            $soapClient = $this->_getSoapClient('customerCustomerRepositoryV1');
            $searchCriteria = [
                'filterGroups' => [
                    [
                        'filters' => [
                            [
                                'field' => 'email',
                                'value' => '%@example.com',
                                'conditionType' => 'like',
                            ],
                        ],
                    ],
                ],
                'pageSize' => 10,
                'currentPage' => 1,
            ];
            $result = $soapClient->customerCustomerRepositoryV1GetList([
                'searchCriteria' => $searchCriteria,
            ]);
            $this->outputResult($result);
        } catch (\SoapFault $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
