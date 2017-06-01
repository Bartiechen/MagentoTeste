<?php

class Yoursite_Newpage_Model_Mysql4_Pessoa_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
  public function _contruct()
  {
    parent::_construct();
        // getModel
        $this->_init('yoursite_newpage/pessoa');
  }
}
