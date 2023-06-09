<?php

namespace Forix\Unit06\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    /**
     * @var \Forix\Unit06\Model\GameFactory
     */
    protected $gameFactory;

    /**
     * @param Action\Context $context
     * @param \Forix\Unit06\Model\GameFactory $gameFactory
     */
    public function __construct(
        Action\Context $context,
        \Forix\Unit06\Model\GameFactory $gameFactory
    )
    {
        $this->gameFactory = $gameFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|(\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
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

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Forix_Unit06::games');
    }
}

