<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/05/17
 * Time: 16:24
 */
class Module_Popup_Block_Popup extends Mage_Core_Block_Template
{
    public function getCollection(){
        return Mage::getModel('module_popup/popup')->getCollection();
    }


}