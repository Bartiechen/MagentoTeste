<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:11
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        # add a fieldset, this returns a Varien_Data_Form_Element_Fieldset object
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => Mage::helper('examples_admingridandform')->__('General Information'),
            )
        );
        # now add fields on to the fieldset object, for more detailed info
        # see https://makandracards.com/magento/12737-admin-form-field-types
        $fieldset->addField(
            'nome', # the input id
            'text', # the type
            array(
                'label'    => Mage::helper('examples_admingridandform')->__('Nome'),
                'class'    => 'required-entry validate-alpha',
                'required' => true,
                'name'     => 'nome',
            )
        );
        $fieldset->addField(
            'email',
            'text',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Email'),
                'class'    => 'required-entry validate-email',
                'required' => true,
                'name'  => 'email',
            )
        );
        $fieldset->addField(
            'telefone',
            'text',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Telefone'),
                'class'    => 'required-entry validate-number',
                'required' => true,
                'name'  => 'telefone',
            )
        );

        $fieldset->addField(
            'sexo',
            'select',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Genero'),
                'value'  => '1',
                'values' => array('Masculino' => 'Masculino','Femenino' => 'Femenino'),
                'class'    => 'required-entry',
                'required' => true,
                'name'  => 'sexo',
            )
        );
        $fieldset->addField(
            'data_envio',
            'text',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Data do Envio'),
                'readonly' => true,
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                'name'  => 'data_envio',
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getThingData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getThingData());
            Mage::getSingleton('adminhtml/session')->getThingData(null);
        } elseif (Mage::registry('thing_data')) {
            $form->setValues(Mage::registry('thing_data')->getData());
        }


        return parent::_prepareForm();
    }

}