<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:24
 */
class Examples_AdminGridAndForm_Block_Thing extends Mage_Core_Block_Template
{
    public function getCollection(){
        return Mage::getModel('learning_lear/contato')->getCollection();
    }


}