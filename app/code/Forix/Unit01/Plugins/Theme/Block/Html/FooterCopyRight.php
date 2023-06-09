<?php

namespace Forix\Unit01\Plugins\Theme\Block\Html;

class FooterCopyRight
{
    public function afterGetCopyright(
        \Magento\Theme\Block\Html\Footer $subject,
        $result
    ) {
        return 'Customized copyright!';
    }
}
