<?php

namespace Forix\Unit01\Plugins\Theme\Block\Html;

class BreadCrumbPlugin
{
    /**
     * @param \Magento\Theme\Block\Html\Breadcrumbs $subject
     * @param $crumbName
     * @param $crumbInfo
     * @return array
     */
    public function beforeAddCrumb(
        \Magento\Theme\Block\Html\Breadcrumbs $subject,
        $crumbName,
        $crumbInfo
    ) {
        if (isset($crumbInfo['label'])) {
            $crumbInfo['label'] = $crumbInfo['label'] .  '(!)';
        }
        return [$crumbName . '(!)', $crumbInfo];
    }
}
