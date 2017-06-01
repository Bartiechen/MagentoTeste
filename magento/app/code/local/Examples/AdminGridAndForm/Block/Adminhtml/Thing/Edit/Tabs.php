<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:19
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('thing_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Contato');
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label'     => 'Edição',
            'title'     => 'Edição',
            'content'   => $this->getLayout()->createBlock('examples_admingridandform/adminhtml_thing_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}