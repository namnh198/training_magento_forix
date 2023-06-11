<?php

namespace Forix\Unit05\Model\ResourceModel\CategoryCountry;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $countryFactory;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    )
    {
        $this->countryFactory = $countryFactory;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    protected function _construct()
    {
        $this->_init(
            \Forix\Unit05\Model\CategoryCountry::class,
            \Forix\Unit05\Model\ResourceModel\CategoryCountry::class
        );
    }

    protected function _afterLoad()
    {
        $country = $this->countryFactory->create();
        foreach ($this->_items as $item) {
            $item->setCountryName($country->loadByCode($item->getCountryId())->getName());
        }
        return parent::_afterLoad();
    }
}
