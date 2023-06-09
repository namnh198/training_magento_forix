<?php

namespace Forix\Unit01\Plugins\Theme\Block\Html;

class FooterCopyRight
{
    /**
     * @param \Magento\Theme\Block\Html\Footer $subject
     * @param $result
     * @return string
     */
    public function afterGetCopyright(
        \Magento\Theme\Block\Html\Footer $subject,
        $result
    ) {
        return 'Customized copyright!';
    }
}
