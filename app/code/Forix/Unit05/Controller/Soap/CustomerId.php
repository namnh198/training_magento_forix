<?php

namespace Forix\Unit05\Controller\Soap;


class CustomerId extends AbstractSoap
{
    public function execute()
    {
        try {
            $soapClient = $this->_getSoapClient('customerCustomerRepositoryV1');
            $result = $soapClient->customerCustomerRepositoryV1GetById([
                'customerId' => 1,
            ]);
            $this->outputResult($result);
        } catch (\SoapFault $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
