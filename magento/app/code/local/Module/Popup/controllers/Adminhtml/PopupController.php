<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/05/17
 * Time: 15:03
 */
class Module_Popup_Adminhtml_PopupController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('module_popup/item');
        $this->renderLayout();
    }

    /**
     * Edit action - shows the edit form
     */
    public function editAction()
    {
        $bannerId = $this->getRequest()->getParam('id');
        $bannerModel = Mage::getModel('module_popup/popup')->load($bannerId);

        if ($bannerModel->getId() || $bannerId == 0) {
            Mage::register('popup_data', $bannerModel);
            $this->loadLayout();
            $this->_setActiveMenu('module_popup/items');

            $this->_addBreadcrumb(Mage::helper('module_popup')->__('Item Manager'), Mage::helper('module_popup')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('module_popup')->__('Item News'), Mage::helper('module_popup')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addLeft($this->getLayout()->createBlock('module_popup/adminhtml_popup_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError('Item não existe.');
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('module_popup/adminhtml_popup_edit_tabs')->toHtml()
        );
    }
}