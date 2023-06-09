<?php

namespace Forix\Unit03\Controller\Index;

use Magento\Framework\App\Action\Context;

class Cms extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Cms\Helper\Page
     */
    protected $pageHelper;

    /**
     * @param Context $context
     * @param \Magento\Cms\Helper\Page $pageHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Cms\Helper\Page $pageHelper
    ) {
        $this->pageHelper = $pageHelper;
        return parent::__construct($context);
    }

    /**
     * @return bool|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->pageHelper->prepareResultPage($this, 'enable-cookies');
    }
}
