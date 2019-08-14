<?php
class Mage_Nextpay_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
	
	public function dynamicreturnAction()
	{
		$order = Mage::getModel('sales/order')->loadByIncrementId($_REQUEST['order']);
		
		try{
			$payment_status = $_REQUEST['payment_status'];
			if($payment_status == 10){
				$payment = $order->getPayment();
				$grandTotal = $order->getBaseGrandTotal();
				if(isset($request['nextpay_order_id'])){
					$tid = $request['nextpay_order_id'];
				}
				else {
					$tid = -1 ;
				}
					
				$payment->setTransactionId($tid)
					->setPreparedMessage("Payment Sucessfull Result:")
					->setIsTransactionClosed(0)
					->registerAuthorizationNotification($grandTotal);
				
				$order->setStatus("payment_approved");
				$order->save();
			}
		}
		catch(Exception $e)
		{
			Mage::logException($e);
		}
	}

	public function returnAction()
	{
		$order = Mage::getModel('sales/order')->loadByIncrementId($_REQUEST['order']);
		
		try{
			$payment_status = $_REQUEST['payment_status'];
			if($payment_status == 2){
				$comment = $order->addStatusHistoryComment('Declined, the order been declined')				
					->setIsCustomerNotified(false)
					->save();
					
				$this->_forward('error');
			}
			elseif($payment_status == 10){
				$comment = $order->sendNewOrderEmail()->addStatusHistoryComment('Approved, the order been approved')
					->setIsCustomerNotified(false)
					->save();
					
				$url = Mage::getUrl('checkout/onepage/success', array('_secure'=>true));
				Mage::register('redirect_url',$url);
				$this->_redirectUrl($url);
			}
		}
		catch(Exception $e)
		{
			Mage::logException($e);
		}
	}

	protected function _getCheckout()
	{
		return Mage::getSingleton('checkout/session');
	}

	public function errorAction()
	{
		$request = $_REQUEST;
		
		$gotoSection = false;
		$session = $this->_getCheckout();
		if ($session->getLastRealOrderId()) {
			$order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
			if ($order->getId()) {
				//Cancel order
				if ($order->getState() != Mage_Sales_Model_Order::STATE_CANCELED) {
					$order->registerCancellation($errorMsg)->save();
				}
				$quote = Mage::getModel('sales/quote')
				->load($order->getQuoteId());
				//Return quote
				if ($quote->getId()) {
					$quote->setIsActive(1)
					->setReservedOrderId(NULL)
					->save();
					$session->replaceQuote($quote);
				}

				//Unset data
				$session->unsLastRealOrderId();
				//Redirect to payment step
				$gotoSection = 'payment';
				$url = Mage::getUrl('checkout/onepage/index', array('_secure'=>true));
				Mage::register('redirect_url',$url);
				$this->_redirectUrl($url);
			}
		}

		return $gotoSection;
	}
}