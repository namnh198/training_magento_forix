<?php

namespace Forix\Unit02\Magento\Framework\App;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;

class FrontController extends \Magento\Framework\App\FrontController
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function dispatch(RequestInterface $request)
    {
        $routerLists = [];
        foreach ($this->_routerList as $router) {
            $routerLists[] = get_class($router);
        }

        $this->getLogger()->info("Magento Router List: \n\r" . implode("\n\r", $routerLists));

        return parent::dispatch($request);
    }

    /**
     * @return mixed|\Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        if (! $this->logger) {
            $this->logger = ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
        }

        return $this->logger;
    }
}
