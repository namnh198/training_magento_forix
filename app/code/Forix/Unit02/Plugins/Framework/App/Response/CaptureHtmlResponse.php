<?php

namespace Forix\Unit02\Plugins\Framework\App\Response;

use Psr\Log\LoggerInterface;

class CaptureHtmlResponse
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function afterSendResponse(
        \Magento\Framework\App\Response\Http $subject,
        $result
    ) {
        $html = $subject->getContent();
        $html = substr($html, 0, 1000);
        $this->logger->info("-----\n\n\n HTML CONTENT\n\n\n\-----" . $html);
        return $result;
    }
}
