<?php
/**
 * Capayable payment method model
 *
 * @category    Tritac
 * @package     Tritac_Capayable
 * @copyright   Copyright (c) 2014 Tritac (http://www.tritac.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class Mage_Nextpay_Model_Payment extends Mage_Payment_Model_Method_Abstract
{
    /**
     * Unique internal payment method identifier
     */
    protected $_code = 'nextpay';
    protected $_paymentMethod    = 'Nextpay';
    protected $_formBlockType = 'nextpay/form';
    protected $_infoBlockType = 'nextpay/info';

    /**
     * Availability options
     */
    protected $_isGateway                   = true;
    protected $_canOrder                    = true;
    protected $_canAuthorize                = true;
    protected $_canCapture                  = true;
    protected $_canCapturePartial           = false;
    protected $_canRefundInvoicePartial     = false;
    protected $_canVoid                     = false;

    /**
     * Extension helper
     */
    protected $_helper                      = null;

    public function __construct()
    {
        $this->_helper = Mage::helper('nextpay');
        // $public_key = $this->getConfigData('public_key');


        parent::__construct();
    }

    /**
     * Get capayable helper
     *
     * @return Mage_Core_Helper_Abstract|Mage_Payment_Helper_Data|null
     */
    public function getHelper() {
        return $this->_helper;
    }

    /**
     * Check customer credit via capayable
     *
     * @param Varien_Object $payment
     * @param float $amount
     * @return $this|Mage_Payment_Model_Abstract
     * @throws Mage_Payment_Model_Info_Exception
     */
    public function authorize(Varien_Object $payment, $amount) {
        return parent::authorize($payment, $amount);
    }

    /**
     * Assign data to info model instance
     * Save capayable customer
     *
     * @param   mixed $data
     * @return  Mage_Payment_Model_Info
     */
    public function assignData($data)
    {    
        $quote = $this->getInfoInstance()->getQuote();
        $billing_address = $quote->getBillingAddress();
        
        if ($billing_address->getRegion() == "") {
            throw new Mage_Payment_Model_Info_Exception("Client state can't be empty");
        }
        
        return parent::assignData($data);
    }

    public function getOrderPlaceRedirectUrl()
    {
        if((int)$this->_getOrderAmount() > 0){
            return Mage::helper('nextpay')->getRedirectUrl();
        }else{
            return false;
        }
    }
    private function _getOrderAmount()
    {
        $info = $this->getInfoInstance();
        if ($this->_isPlacedOrder()) {
            return (double)$info->getOrder()->getQuoteBaseGrandTotal();
        } else {
            return (double)$info->getQuote()->getBaseGrandTotal();
        }
    }
    private function _isPlacedOrder()
    {
        $info = $this->getInfoInstance();
        if ($info instanceof Mage_Sales_Model_Quote_Payment) {
            return false;
        } elseif ($info instanceof Mage_Sales_Model_Order_Payment) {
            return true;
        }
    }
}