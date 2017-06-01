<?php

class Learning_Lear_Model_Mysql4_Contato_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
  public function _contruct()
  {
    parent::_construct();
        // getModel
        $this->_init('learning_learning/learning');
  }
}
