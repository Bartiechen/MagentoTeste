<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/17
 * Time: 14:15
 */
class Learning_Lear_Block_Adminhtml_Adminform_Edit extends  Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for form containers, parent constructor should be called first

        $this->_objectId = 'id'; # this is the param we look for in the url to load the entity
        $this->_controller = 'admingridform_adminhtml'; # same as the grid container
        $this->_blockGroup = 'learning_lear'; # same as the grid container
        $this->_updateButton('save', 'label', Mage::helper('learning_lear')->__('Save Thing')); # sets the text for the save button
        $this->_updateButton('delete', 'label', Mage::helper('learning_lear')->__('Delete Thing')); # sets the text for the delete button
        # adds a save and continue edit button, not needed but nice
        $this->_addButton(
            'save_and_edit_button',
            array(
                'label'     => Mage::helper('learning_lear')->__('Save and Continue Edit'),
                'onclick'   => 'saveAndContinueEdit()',
                'class'     => 'save'
            ),
            100
        );
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        # the text changes depending on if we are editing an existing entity
        # or creating a new one, this is based on a registry item that the
        # controller registers, this will never exist in our examples as we
        # don't have the controller logic to support it
        if (Mage::registry('thing_data') && Mage::registry('thing_data')->getId() ) {
            return Mage::helper('learning_lear')->__("Edit Thing");
        } else {
            return Mage::helper('learning_lear')->__('Add Thing');
        }
    }

    /**
     * Header CSS class
     *
     * Used to set the icon next to the header text, not at all needed but a
     * nice touch. Look at all the headers to see the available icons, or make
     * your own by omitting this and making a CSS rule for .head-adminhtml-thing
     *
     * @return string The CSS class
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-page';
    }
}