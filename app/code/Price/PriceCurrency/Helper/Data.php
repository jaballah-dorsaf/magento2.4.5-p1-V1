<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Price\PriceCurrency\Helper;

use Magento\Store\Model\Store;

/**
 * Sales module base helper
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** 
     * Custom fee config path
     *    *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendNewOrderConfirmationEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\OrderIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send new order email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendNewOrderEmail($store = null)
    {
        return $this->canSendNewOrderConfirmationEmail($store);
    }

    /**
     * Check allow to send order comment email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendOrderCommentEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\OrderCommentIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send new shipment email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendNewShipmentEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\ShipmentIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send shipment comment email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendShipmentCommentEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\ShipmentCommentIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
    /**
     * Check allow to send new invoice email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendNewInvoiceEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\InvoiceIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send invoice comment email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendInvoiceCommentEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\InvoiceCommentIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send new creditmemo email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendNewCreditmemoEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\CreditmemoIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Check allow to send creditmemo comment email
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function canSendCreditmemoCommentEmail($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            \Magento\Sales\Model\Order\Email\Container\CreditmemoCommentIdentity::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
    const CONFIG_CUSTOM_IS_ENABLED = 'Extrafee/Extrafee/status';
    const CONFIG_CUSTOM_FEE = 'Extrafee/Extrafee/Extrafee_amount';
    const CONFIG_FEE_LABEL = 'Extrafee/Extrafee/name';
    const CONFIG_MINIMUM_ORDER_AMOUNT = 'Extrafee/Extrafee/minimum_order_amount';

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::CONFIG_CUSTOM_IS_ENABLED, $storeScope);
    }

    /**
     * Get custom fee
     *
     * @return mixed
     */
    public function getExtrafee()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::CONFIG_CUSTOM_FEE, $storeScope);
    }

    /**
     * Get custom fee
     *
     * @return mixed
     */
    public function getFeeLabel()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::CONFIG_FEE_LABEL, $storeScope);
    }

    /**
     * @return mixed
     */
    public function getMinimumOrderAmount()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::CONFIG_MINIMUM_ORDER_AMOUNT, $storeScope);
    }
}
