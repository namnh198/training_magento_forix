<?php

namespace Forix\Unit06\Block\Adminhtml\Vendor;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * Edit Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context context
     * @param \Magento\Framework\Registry $registry CoreRegistry
     * @param array $data data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize blog Brand edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'vendor_id';
        $this->_blockGroup = 'Forix_Unit06';
        $this->_controller = 'adminhtml_vendor';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Vendor'));
        $this->buttonList->add(
            'save_continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ],
                    ],
                ]
            ],
            -100
        );

        if ($this->isAllowedAction('Forix_Unit06::vendor')) {
            $this->buttonList->update('delete', 'label', __('Delete Vendor'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve text for header element depending on loaded Brand
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $vendor = $this->coreRegistry->registry('vendor');
        if ($vendor->getId()) {
            return __(
                "Edit Vendor '%1'",
                $this->escapeHtml($vendor->getVendorName())
            );
        } else {
            return __('New Vendor');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId resourceId
     *
     * @return bool
     */
    protected function isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save',
            ['_current' => true, 'back' => 'edit', 'active_tab' => '']
        );
    }
}
