<?php

  class Magento_PrimeiroController_PrimeirocontrollerController extends Mage_Core_Controller_Front_Action
  {
    public function minhaAction()
    {
      $this->loadLayout();
      echo 'talves tenha funcionado';
      $this->renderLayout();
        // $this->_forward('actionforward');
    }

    public function actionforwardAction()
    {
      echo 'Action Forward.';
    }

    public function actionredirectAction()
    {
      echo 'Action Redirect.';
    }
  }
