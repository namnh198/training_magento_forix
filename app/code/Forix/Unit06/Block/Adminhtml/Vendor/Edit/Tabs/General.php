<?php

namespace Forix\Unit06\Block\Adminhtml\Vendor\Edit\Tabs;

use Forix\Unit06\Model\Vendor;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class General extends Generic implements TabInterface
{
    /**
     * @var Vendor
     */
    protected $vendor;

    /**
     * @param Context $context context
     * @param Registry $registry registry
     * @param FormFactory $formFactory formFactory
     * @param Vendor $vendor
     * @param array $data data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Vendor $vendor,
        array $data = []
    ) {
        $this->vendor = $vendor;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return General
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('vendor');

        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype'=>'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Vendor Details'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('vendor_id', 'hidden', ['name' => 'vendor_id']);
        }

        $fieldset->addField(
            'vendor_name',
            'text',
            [
                'name' => 'vendor_name',
                'label' => __('Vendor Name'),
                'title' => __('Vendor Name'),
                'class' => 'required-entry',
                'required' => true
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'values' => $this->vendor->getAvailableStatuses()
            ]
        );

        if (!$model->getId()) {
            $model->setData('status', '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId resourceId
     *
     * @return boolean
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
