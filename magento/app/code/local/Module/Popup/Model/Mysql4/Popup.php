<?php
class Module_Popup_Model_Mysql4_Popup extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // getTable
        $this->_init('module_popup/popup', 'id_popup');
    }

    protected function _beforeSave(Mage_Core_Model_Abstract $object) {
        if ($object->isObjectNew()) {
            $object->created_at = date('Y-m-d H:i:s');
        }

        $object->updated_at = date('Y-m-d H:i:s');

        return parent::_beforeSave($object);
    }
}