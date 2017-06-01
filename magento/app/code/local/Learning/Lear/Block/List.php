<?php
/**
 *
 */
class Learning_Lear_Block_List extends Mage_Core_Block_Template
{
    public function getDataLearning()
    {

      $contatos = Mage::getModel('learning_lear/contato')->getCollection();

      return $contatos;
    }

}


 ?>
