<?php
namespace Mytek\CheckoutCustomField\Observer;
 
class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
 
        $order->setData('custom_field_text', $quote->getCustomFieldText());
 
        return $this;
    }
}
