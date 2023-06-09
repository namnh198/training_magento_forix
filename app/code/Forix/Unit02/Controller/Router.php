<?php

namespace Forix\Unit02\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionPath;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     */
    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory) {
        $this->actionPath = $actionFactory;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(\Magento\Framework\App\RequestInterface $request) {
        $testCategory = 'id/6';
        $info = $request->getPathInfo();
        if (preg_match("%^/(test)-(.*?)-(.*?)$%", $info, $m)) {
            $request->setPathInfo(sprintf("/%s/%s/%s/%s", $m[1], $m[2], $m[3], $testCategory));
            return $this->actionPath->create(\Magento\Framework\App\Action\Forward::class);
        }
        return null;
    }
}
