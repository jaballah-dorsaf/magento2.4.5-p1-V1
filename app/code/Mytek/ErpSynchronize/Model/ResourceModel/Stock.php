<?php

namespace Mytek\ErpSynchronize\Model\ResourceModel;

class Stock extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'CODE';
    protected $_isPkAutoIncrement = false;


    protected function _construct()
    {
        $this->_init('mytek_erp_synchronize','CODE');
    }




    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Mytek\ErpSynchronize\Model\Stock|AbstractModel $object
     * @return Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        // $entityMetadata = $this->metadataPool->getMetadata(StockInterface::class);
        // $linkField = $entityMetadata->getLinkField();

        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $stores = [(int)$object->getStoreId(), Store::DEFAULT_STORE_ID];

            $select->join(
                ['mew' => $this->getTable('mytek_erp_warehouse')],
                $this->getMainTable() . '.' . 'CODE' . ' = mew.' . 'REF_ARTICLE',
                ['CODE']
            )

                ->limit(50);
        }

        return $select;
    }










    // /**
    //  * Retrieve select object for load object data
    //  *
    //  * @param string $field
    //  * @param mixed $value
    //  * @param \Magento\Framework\Model\AbstractModel $object
    //  * @return \Magento\Framework\DB\Select
    //  */
    // protected function _getLoadSelect($field, $value, $object)
    // {
    //     $field = $this->getConnection()->quoteIdentifier(sprintf('%s.%s', $this->getMainTable(), $field));
    //     $select = $this->getConnection()
    //         ->select()
    //         ->from($this->getMainTable())
    //         ->where($field . '=?', $value)
    //         ->join('sales_order',
    //         'mailing_sign_up.sales_order_id = sales_order.entity_id',
    //         [
    //             'customer_id',
    //             'grand_total'
    //         ])->join('customer_entity',
    //         'sales_order.customer_id = customer_entity.entity_id',
    //         [
    //             'email'
    //         ]);
    //     return $select;
    // }



}