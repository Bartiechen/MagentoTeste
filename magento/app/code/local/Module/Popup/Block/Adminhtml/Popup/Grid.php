<?php

class Module_Popup_Block_Adminhtml_Popup_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for grids, parent constructor should be called first

        $this->setId('popupGrid'); # not sure where the grid id gets used
        $this->setDefaultSort('id_popup'); # sets the default sort column
        $this->setDefaultDir('asc'); # sets the default sort direction
        $this->setSaveParametersInSession(true); # this sets filters and sorts in the session, as opposed to using the url
    }


    protected function _prepareCollection()
    {
        # normally you would use a resource collection model to supply a
        # database-derived collection, but we're using a static collection
        # so that we don't have to use a real collection

        $popups = Mage::getModel('module_popup/popup')->getCollection();

        $this->setCollection($popups);

        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {

        $this->addColumn(
            'id', # the column id
            array(
                'header'   => Mage::helper('module_popup')->__('Id'),
                'align'     =>'right',
                'width'     => '50px',
                'index'    => 'id_popup' # index is the name of the data in the entity
            )
        );
        $this->addColumn(
            'mensagem',
            array(
                'header' => Mage::helper('module_popup')->__('Mensagem'),
                'align' => 'left',
                'index'  => 'mensagem'
            )
        );
        $this->addColumn(
            'imagem',
            array(
                'header' => Mage::helper('module_popup')->__('Imagem'),
                'index'  => 'imagem',
                'filter' => false # defaults to having a filter - don't set to true, this breaks things - just omit if wanting a filter
            )
        );
        $this->addColumn(
            'data_inicio',
            array(
                'type'   => 'date',
                'header' => Mage::helper('module_popup')->__('Data Inicial'),
                'width'  => '50px',
                'index'  => 'data_inicio' # notice how index and the column id are different? this shows that index defines the data key
            )
        );

        $this->addColumn(
            'data_final',
            array(
                'type'   => 'date',
                'header' => Mage::helper('module_popup')->__('Data Final'),
                'width'  => '50px',
                'index'  => 'data_final' # notice how index and the column id are different? this shows that index defines the data key
            )
        );

        return parent::_prepareColumns();
    }


    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getIdPopup()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }


    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id_popup');
        $this->getMassactionBlock()->setFormFieldName('popup');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'   => Mage::helper('module_popup')->__('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('module_popup')->__('Are you sure?')
            )
        );
        return $this;
    }
}
