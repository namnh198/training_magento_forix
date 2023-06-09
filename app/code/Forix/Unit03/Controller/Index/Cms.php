<?php

namespace Forix\Unit03\Controller\Index;

use Magento\Framework\App\Action\Context;

class Cms extends \Magento\Framework\App\Action\Action
{
    protected $pageHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Cms\Helper\Page $pageHelper
    ) {
        $this->pageHelper = $pageHelper;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageHelper->prepareResultPage($this, 'enable-cookies');
    }
}
