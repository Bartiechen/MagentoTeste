<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/17
 * Time: 14:01
 */
class Learning_Lear_Admingridform_Adminhtml extends  Mage_Adminhtml_Controller_Action
{
    public function indexAction(){
        $this->loadLayout();
        $this->_setActiveMenu('lear_adminform/item');
        $this->renderLayout();

    }

    public function editAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('lear_adminform/item');
        $this->renderLayout();
    }
}