<?php
class Yoursite_Newpage_Model_Pessoa extends Mage_Core_Model_Abstract
{
  public function _construct()
  {
    //parent::_construct();
    $this->_init('yoursite_newpage/pessoa');
  }
}
