<?php

namespace Forix\Unit03\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class OnePage extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Raw|(\Magento\Framework\Controller\Result\Raw&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $layout = $this->resultFactory->create(ResultFactory::TYPE_PAGE)->getLayout();
        $block = $layout->createBlock(\Forix\Unit03\Block\OnePage::class);
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($block->toHtml());
        return $result;
    }
}
