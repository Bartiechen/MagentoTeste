<?php
class Yoursite_Newpage_IndexController extends Mage_Core_Controller_Front_Action
{
  public function indexAction()
  {
    $this->loadLayout();

    // $block = $this->getLayout()->createBlock(
    //         'Mage_Core_Block_Template',
    //         'newpage',
    //         array('template' => 'newpage/content.phtml')
    //     );

    // $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');
    // $this->getLayout()->getBlock('content')->append($block);
    $this->_initLayoutMessages('core/session');
    $this->renderLayout();

  }

  public function cadastroAction()
  {

    $nome = $this->getRequest()->getPost('name');
    $sobrenome = $this->getRequest()->getPost('lastname');
    $texto = $this->getRequest()->getPost('texto');

    if($sobrenome === ""){
      unset($sobrenome);
      $sobrenome = null;
    }

    $pessoa =  array('name' => $nome,'lastname' => $sobrenome, 'descricao' => $texto );

    try {
      Mage::getModel('yoursite_newpage/pessoa')->setData($pessoa)->save();
      Mage::getSingleton('core/session')->addSuccess("Cadastrado com sucesso");
      $this->_redirect('newpage');
    } catch (Exception $e) {
      Mage::getSingleton('core/session')->addError("Erro ao cadastrar. Nenhum campo pode estar vazio");
      $this->_redirect('newpage/index/create');
    }

  }

  public function createAction()
  {
    $this->loadLayout();
    $this->_initLayoutMessages('core/session');
    $this->renderLayout();
  }
}
