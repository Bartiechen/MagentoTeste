<?php
/**
 * Examples
 *
 * PHP Version 5
 *
 * @category  Examples
 * @package   Examples_AdminGridAndForm
 * @author    Mike Whitby <me@mikewhitby.co.uk>
 * @copyright Copyright (c) 2012 Mike Whitby (http://www.mikewhitby.co.uk)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A
 */

/**
 * Thing grid
 *
 * This class gets instantiated by it's container, which is of type
 * {@link Examples_AdminGridAndForm_Block_Adminhtml_Thing}. This class is
 * responsible for creating the actual HTML tables for the grid
 *
 * @category Examples
 * @package  Examples_AdminGridAndForm
 * @author   Mike Whitby <me@mikewhitby.co.uk>
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for grids, parent constructor should be called first

        $this->setId('learningGrid'); # not sure where the grid id gets used
        $this->setDefaultSort('id_learning'); # sets the default sort column
        $this->setDefaultDir('asc'); # sets the default sort direction
        $this->setSaveParametersInSession(true); # this sets filters and sorts in the session, as opposed to using the url
        $this->setUseAjax(true);
    }


    protected function _prepareCollection()
    {
        # normally you would use a resource collection model to supply a
        # database-derived collection, but we're using a static collection
        # so that we don't have to use a real collection

        $contatos = Mage::getModel('learning_lear/contato')->getCollection();

        $this->setCollection($contatos);

        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {

        $this->addColumn(
            'id', # the column id
            array(
                'header'   => 'Id',
                'align'     =>'right',
                'width'     => '50px',
                'index'    => 'id_learning' # index is the name of the data in the entity
            )
        );
        $this->addColumn(
            'nome',
            array(
                'header' => 'Nome',
                'align' => 'left',
                'index'  => 'nome'
            )
        );
        $this->addColumn(
            'email',
            array(
                'header' => 'Email',
                'index'  => 'email',
                'filter' => false # defaults to having a filter - don't set to true, this breaks things - just omit if wanting a filter
            )
        );
        $this->addColumn(
            'data_envio',
            array(
                'type'   => 'date',
                'header' => Mage::helper('examples_admingridandform')->__('Data do Envio'),
                'width'  => '50px',
                'index'  => 'data_envio' # notice how index and the column id are different? this shows that index defines the data key
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
        Mage::log($row->getId());
        return $this->getUrl('*/*/edit', array('id' => $row->getIdLearning()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * Prepare grid mass actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id_learning');
        $this->getMassactionBlock()->setFormFieldName('thing');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'   => Mage::helper('examples_admingridandform')->__('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('examples_admingridandform')->__('Are you sure?')
            )
        );
        return $this;
    }
}
