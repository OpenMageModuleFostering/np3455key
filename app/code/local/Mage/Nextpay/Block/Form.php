<?php
/**
 * @category    Tritac
 * @package     Tritac_Capayable
 * @copyright   Copyright (c) 2014 Tritac (http://www.tritac.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class Mage_Nextpay_Block_Form extends Mage_Payment_Block_Form
{
    /**
     * @var Mage_Sales_Model_Quote
     */
    protected $_quote;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('nextpay/form.phtml');
    }

    /**
     * Get quote
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getQuote() {
        if(!$this->_quote) {
            $this->_quote = $this->getMethod()->getInfoInstance()->getQuote();
        }

        return $this->_quote;
    }

}
