<?php

namespace Forix\Unit06\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    protected $gameFactory;

    public function __construct(
        Action\Context $context,
        \Forix\Unit06\Model\GameFactory $gameFactory
    )
    {
        $this->gameFactory = $gameFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $gameId = $this->getRequest()->getParam('game_id');
        $model = $this->gameFactory->create();
        $model->load($gameId);
        $model->delete();
        $this->messageManager->addSuccessMessage(__('Delete Games successfully'));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Forix_Unit06::games');
    }
}

