<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:11
 */
class Module_Popup_Block_Adminhtml_Popup_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        # add a fieldset, this returns a Varien_Data_Form_Element_Fieldset object
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => Mage::helper('module_popup')->__('General Information'),
            )
        );
        # now add fields on to the fieldset object, for more detailed info
        # see https://makandracards.com/magento/12737-admin-form-field-types
        $fieldset->addField(
            'mensagem', # the input id
            'text', # the type
            array(
                'label' => Mage::helper('module_popup')->__('Mensagem'),
                'name' => 'mensagem',
            )
        );
        $fieldset->addField(
            'imagem',
            'file',
            array(
                'label' => Mage::helper('module_popup')->__('Imagem'),
                'name' => 'imagem',
            )
        );
        $fieldset->addField(
            'data_inicio',
            'date',
            array(
                'label' => Mage::helper('module_popup')->__('Data Inicial'),
                'tabindex' => 1,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                'required' => true,
                'name' => 'data_inicio',
            )
        );

        $fieldset->addField(
            'data_final',
            'select',
            array(
                'label' => Mage::helper('module_popup')->__('Data Final'),
                'tabindex' => 1,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                'required' => true,
                'name' => 'data_final',
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getPopupData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPopupData());
            Mage::getSingleton('adminhtml/session')->getPopupData(null);
        } elseif (Mage::registry('popup_data')) {
            $form->setValues(Mage::registry('popup_data')->getData());
        }


        return parent::_prepareForm();
    }

}