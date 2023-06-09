<?php

namespace Forix\Unit02\Plugins\Framework\App\Response;

use Psr\Log\LoggerInterface;

class CaptureHtmlResponse
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\App\Response\Http $subject
     * @param $result
     * @return mixed
     */
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
