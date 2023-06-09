<?php

namespace Forix\Unit06\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param Action\Context $context
     */
    public function __construct(
        PageFactory    $resultPageFactory,
        Registry       $coreRegistry,
        Action\Context $context
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Game'));
        $gameId = $this->getRequest()->getParam('game_id');
        $this->coreRegistry->register('game_id', $gameId);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Forix_Unit06::games');
    }
}
