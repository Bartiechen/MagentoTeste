<?php

class Learning_Lear_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('core/session');
        $this->renderLayout();
    }

    public function createAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('core/session');
        $this->renderLayout();
    }

    public function cadastroAction()
    {

        $nome = $this->getRequest()->getPost('name');
        $email = $this->getRequest()->getPost('email');
        $telefone = $this->getRequest()->getPost('phone');
        $genero = $this->getRequest()->getPost('gender');

        $contato = array('nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'sexo' => $genero);

        try {
            Mage::getModel('learning_lear/contato')->setData($contato)->save();
            Mage::getSingleton('core/session')->addSuccess("Cadastrado com sucesso");
            $this->_redirect('learning');
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError("Erro ao cadastrar. Nenhum campo pode estar vazio");
            $this->_redirect('learning');
        }

    }

}
