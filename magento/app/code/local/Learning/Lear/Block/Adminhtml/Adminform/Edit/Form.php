<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/17
 * Time: 14:26
 */
class Learning_Lear_Block_Adminhtml_Adminform_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        # create the form with the essential information, such as DOM ID, action
        # attribute, method and the enc type (this is needed if you have image
        # inputs in your form, and doesn't hurt to use otherwise)
        $form = new Varien_Data_Form(
            array(
                'id'      => 'edit_form',
                'action'  => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method'  => 'post',
                'enctype' => 'multipart/form-data'
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        # you can add fields direct to the form, without a fieldset
        $form->addField(
            'fake_note',
            'note',
            array(
                'text' => '<ul class="messages"><li class="notice-msg"><ul><li>'
                    .  Mage::helper('learning_lear')->__('This form is fake, so the data in the grid '
                        . 'you just clicked on won\'t be here, do not be alarmed, this is normal')
                    . '</li></ul></li></ul>',
            )
        );

        # add a fieldset, this returns a Varien_Data_Form_Element_Fieldset object
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => Mage::helper('learning_lear')->__('General Information'),
            )
        );
        # now add fields on to the fieldset object, for more detailed info
        # see https://makandracards.com/magento/12737-admin-form-field-types
        $fieldset->addField(
            'name', # the input id
            'text', # the type
            array(
                'label'    => Mage::helper('learning_lear')->__('Name'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'name',
            )
        );
        $fieldset->addField(
            'short_description',
            'textarea',
            array(
                'label' => Mage::helper('learning_lear')->__('Short Description'),
                'name'  => 'short_description',
            )
        );
        $fieldset->addField(
            'long_description',
            'textarea',
            array(
                'label' => Mage::helper('learning_lear')->__('Long Description'),
                'name'  => 'long_description',
                'note'  => 'The long description didn\'t appear in the grid',
            )
        );

        # we can use multiple fieldsets
        $fieldset = $form->addFieldset(
            'stock_fieldset',
            array(
                'legend' => Mage::helper('learning_lear')->__('Stock'),
            )
        );
        $fieldset->addField(
            'stock_note',
            'note',
            array(
                'text' => Mage::helper('learning_lear')->__('A note field can be used to inform users of '
                    . 'something, they look a bit naff though. You can add any HTML you fancy to '
                    . 'make them look better, such as the note at the top of this form does'),
            )
        );
        $fieldset->addField(
            'quantity',
            'text',
            array(
                'label'    => Mage::helper('learning_lear')->__('Quantity'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'quantity',
            )
        );

        return parent::_prepareForm();
    }
}