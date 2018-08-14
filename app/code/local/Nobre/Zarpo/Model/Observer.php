<?php
class Nobre_Zarpo_Model_Observer extends Mage_Core_Model_Abstract {
    public function addItem($observer)
    {
        $quote_item = $observer->getEvent()->getQuoteItem();
        $item_date = $quote_item->getProduct()->getData('date_of_delivery');

        $session = Mage::getSingleton('checkout/session');
        foreach ($session->getQuote()->getAllItems() as $item) {
            $product = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            if ($product->getDateOfDelivery() !== $item_date) {
                Mage::throwException('Date of Delivery is different from other products in cart');
            }

        }
    }
}