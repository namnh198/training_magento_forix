<?php

namespace Forix\Unit05\Controller\Soap;

class Product extends AbstractSoap
{
    public function execute()
    {
        try {
            $soapClient = $this->_getSoapClient('catalogProductRepositoryV1');
            $result = $soapClient->catalogProductRepositoryV1Get([
                'sku' => '24-MB01',
                'attributes' => ['name', 'price', 'custom_multiselect'],
            ]);
            $this->outputResult($result);
        } catch (\SoapFault $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
