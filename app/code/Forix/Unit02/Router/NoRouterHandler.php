<?php

namespace Forix\Unit02\Router;

class NoRouterHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        if ($request->getFrontName() == 'admin') {
            return false;
        }

        $request->setModuleName('cms')
            ->setControllerName('index')
            ->setActionName('index');
        return true;
    }
}
