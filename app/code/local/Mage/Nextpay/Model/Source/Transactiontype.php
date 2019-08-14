<?php
class Mage_Nextpay_Model_Source_Transactiontype
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Sale')),
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Pre-Authorization')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => Mage::helper('adminhtml')->__('Sale'),
            1 => Mage::helper('adminhtml')->__('Pre-Authorization'),
        );
    }

}