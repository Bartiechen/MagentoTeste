<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/17
 * Time: 14:16
 */
class Learning_Lear_Block_Adminhtml_Adminform_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for grids, parent constructor should be called first

        $this->setId('thingGrid'); # not sure where the grid id gets used
        $this->setDefaultSort('name'); # sets the default sort column
        $this->setDefaultDir('asc'); # sets the default sort direction
        $this->setSaveParametersInSession(true); # this sets filters and sorts in the session, as opposed to using the url
    }

    /**
     * Prepare grid collection object
     *
     * @return Examples_AdminGridAndForm_Block_Adminhtml_Thing_Grid
     */
    protected function _prepareCollection()
    {
        # normally you would use a resource collection model to supply a
        # database-derived collection, but we're using a static collection
        # so that we don't have to use a real collection
        $item1 = new Varien_Object();
        $item1->setData(array(
            'thing_id'          => 1,
            'name'              => 'Item 1',
            'short_description' => 'A very nice shiny thing',
            'quantity'          => 10,
        ));
        $item2 = new Varien_Object();
        $item2->setData(array(
            'thing_id'          => 2,
            'name'              => 'Item 2',
            'short_description' => 'A very nice dull matte black thing',
            'quantity'          => 2,
        ));
        $item3 = new Varien_Object();
        $item3->setData(array(
            'thing_id'          => 3,
            'name'              => 'Item 3',
            'short_description' => 'A paticularly obnoxious peice of wood',
            'quantity'          => 90,
        ));
        $collection = new Varien_Data_Collection();
        $collection->addItem($item1);
        $collection->addItem($item2);
        $collection->addItem($item3);
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Examples_AdminGridAndForm_Block_Adminhtml_Thing_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'thing_id', # the column id
            array(
                'type'     => 'number', # needed for using a ranged filter
                'header'   => Mage::helper('learnin_lear')->__('ID'),
                'width'    => '50px',
                'index'    => 'thing_id', # index is the name of the data in the entity
                'sortable' => true, # defaults to true so this is pointless, just using as an example, can be true or false
            )
        );
        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('learnin_lear')->__('Name'),
                'width'  => '400px',
                'index'  => 'name',
            )
        );
        $this->addColumn(
            'short_description',
            array(
                'header' => Mage::helper('learnin_lear')->__('Short Description'),
                'index'  => 'short_description',
                'filter' => false, # defaults to having a filter - don't set to true, this breaks things - just omit if wanting a filter
            )
        );
        $this->addColumn(
            'quantity_test',
            array(
                'type'   => 'number',
                'header' => Mage::helper('learnin_lear')->__('Quantity'),
                'width'  => '50px',
                'index'  => 'quantity', # notice how index and the column id are different? this shows that index defines the data key
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Return a URL to be used for each row
     *
     * If you don't wish rows to return a URL, simply omit this method
     *
     * @param Varien_Object $row The row for which to supply a URL
     *
     * @return string The row URL
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Prepare grid mass actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('thing_id');
        $this->getMassactionBlock()->setFormFieldName('thing');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'   => Mage::helper('learnin_lear')->__('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('learnin_lear')->__('Are you sure?')
            )
        );
        return $this;
    }
}