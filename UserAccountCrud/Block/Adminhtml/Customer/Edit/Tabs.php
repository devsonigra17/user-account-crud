<?php

namespace Dev\UserAccountCrud\Block\Adminhtml\Customer\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;

class Tabs extends Generic implements TabInterface
{
    protected $_systemStore;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    public function getTabLabel()
    {
        return __('CRUD');
    }

    public function getTabTitle()
    {
        return __('CRUD');
    }

    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    public function getTabClass()
    {
        return '';
    }

    public function getTabUrl()
    {
        return '';
    }

    public function isAjaxLoaded()
    {
        return false;
    }

    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('myform_');
        
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Fields Information')]);
        $rowcom = "test";
        $fieldset->addField(
            'demo_field',
            'text',
            [
                'name' => 'demo_field',
                'data-form-part' => $this->getData('target_form'),
                'label' => __('Demo Field in Customer Section'),
                'title' => __('Demo Field in Customer Section'),
                'value' => $rowcom,
            ]
        );
        $this->setForm($form);
        return $this;
    }

    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}