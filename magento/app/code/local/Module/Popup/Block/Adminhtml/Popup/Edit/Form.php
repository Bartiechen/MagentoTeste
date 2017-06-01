<?php

/**
 *
 * @author     Darko Goleš <darko.goles@inchoo.net>
 */
class Module_Popup_Block_Adminhtml_Popup_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

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
        return parent::_prepareForm();
    }

}