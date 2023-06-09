<?php

namespace Forix\Unit05\Controller\Index;

use Forix\Unit05\Api\TrainingRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Training extends Action
{

    /**
     * @var TrainingRepositoryInterface
     */
    private $trainingRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @param Context $context
     * @param TrainingRepositoryInterface $trainingRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     */
    public function __construct(
        Context $context,
        TrainingRepositoryInterface $trainingRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder
    ) {
        $this->trainingRepository = $trainingRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->setHeader('content-type', 'text/plain');
        $filters[] = array_map(function ($name) {
            return $this->filterBuilder
                ->setConditionType('eq')
                ->setField('name')
                ->setValue($name)
                ->create();
        }, ['Foo', 'Bar', 'Baz', 'Qux']);
        $this->searchCriteriaBuilder->addFilters($filters);
        $trainings = $this->trainingRepository->getList(
            $this->searchCriteriaBuilder->create()
        )->getItems();
        foreach ($trainings as $training) {
            $this->getResponse()->appendBody(sprintf(
                "%s (%d)\n",
                $training->getName(),
                $training->getId()
            ));
        }
    }
}
