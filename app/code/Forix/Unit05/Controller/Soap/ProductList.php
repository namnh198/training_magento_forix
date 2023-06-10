<?php

namespace Forix\Unit05\Controller\Soap;

class ProductList extends AbstractSoap
{

    public function execute()
    {
        $searchCriteria = [
            'filterGroups' => [
                [
                    'filters' => [
                        [
                            'field' => 'status',
                            'value' => '1',
                            'conditionType' => 'eq',
                        ],
                    ],
                ],
            ],
            'pageSize' => 10,
            'currentPage' => 1,
        ];
        try {
            $soapClient = $this->_getSoapClient('catalogProductRepositoryV1');
            $result = $soapClient->catalogProductRepositoryV1GetList([
                'searchCriteria' => $searchCriteria,
            ]);
            $this->outputResult($result);
        } catch (\SoapFault $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
