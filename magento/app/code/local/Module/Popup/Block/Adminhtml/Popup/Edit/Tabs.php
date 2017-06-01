<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:19
 */
class Module_Popup_Block_Adminhtml_Popup_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('popup_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Popup');
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label'     => 'Edição',
            'title'     => 'Edição',
            'content'   => $this->getLayout()->createBlock('module_popup/adminhtml_popup_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}