<?php
/**
 *
 */
class Yoursite_Newpage_Block_List  extends Mage_Core_Block_Template
{
  public function getDataNewpage()
  {

    $pessoas = Mage::getModel('yoursite_newpage/pessoa')->getCollection();

    return $pessoas;
  }

}
