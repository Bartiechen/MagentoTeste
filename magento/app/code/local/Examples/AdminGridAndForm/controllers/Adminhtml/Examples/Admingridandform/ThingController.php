<?php
/**
 * Examples
 *
 * PHP Version 5
 *
 * @category  Examples
 * @package   Examples_AdminGridAndForm
 * @author    Mike Whitby <me@mikewhitby.co.uk>
 * @copyright Copyright (c) 2012 Mike Whitby (http://www.mikewhitby.co.uk)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A
 */

/**
 * Thing controller
 *
 * @category Examples
 * @package  Examples_AdminGridAndForm
 * @author   Mike Whitby <me@mikewhitby.co.uk>
 */
class Examples_AdminGridAndForm_Adminhtml_Examples_Admingridandform_ThingController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index action - shows the grid
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('examples_admingridandform/item');
        $this->renderLayout();
    }

    /**
     * Edit action - shows the edit form
     */
    public function editAction()
    {
        $bannerId = $this->getRequest()->getParam('id');
        $bannerModel = Mage::getModel('learning_lear/contato')->load($bannerId);

        if ($bannerModel->getId() || $bannerId == 0) {
            Mage::register('thing_data', $bannerModel);
            $this->loadLayout();
            $this->_setActiveMenu('examples_admingridandform/items');

            $this->_addBreadcrumb(Mage::helper('examples_admingridandform')->__('Item Manager'), Mage::helper('examples_admingridandform')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('examples_admingridandform')->__('Item News'), Mage::helper('examples_admingridandform')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addLeft($this->getLayout()->createBlock('examples_admingridandform/adminhtml_thing_edit_tabs'));
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

    function massDeleteAction()
    {
        $bannerIds = $this->getRequest()->getParam('thing');
        if (!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('examples_admingridandform')->__('Please select tax(es).'));
        } else {
            try {
                $bannerModel = Mage::getModel('learning_lear/contato');
                foreach ($bannerIds as $bannerId) {
                    $item = $bannerModel->load($bannerId);
                    $item->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('examples_admingridandform')->__('Total of %d record(s) were deleted.', count($bannerIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $bannerModel = Mage::getModel('learning_lear/contato');
                $item = $bannerModel->load($this->getRequest()->getParam('id'));
                $item->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess('Item deletado com sucesso.');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }

        $this->_redirect('*/*/');
    }

    public function saveAction()
    {

        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                $model = Mage::getModel('learning_lear/contato');

                $model->setIdLearning($this->getRequest()
                    ->getParam('id'))->setNome($postData['nome'])
                    ->setEmail($postData['email'])
                    ->setTelefone($postData['telefone'])
                    ->setSexo($postData['sexo'])
                ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Item salvo com sucesso.');
                $this->_redirect('*/*/index');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setTestimonialsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('examples_admingridandform/adminhtml_thing_grid')->toHtml()
        );
    }
}

