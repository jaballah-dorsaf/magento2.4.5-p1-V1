<?php

namespace Mytek\ErpSynchronize\Model\ResourceModel\Stock;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'CODE';
    protected $_eventPrefix = 'mytek_erp_synchronize_collection';
    protected $_eventObject = 'synchronize_collection';

    protected function _construct()
    {
        $this->_init('Mytek\ErpSynchronize\Model\Stock', 'Mytek\ErpSynchronize\Model\ResourceModel\Stock');
    }


    public function filterStock($code)
    {
        // $this->sales_order_table = "main_table";
        // $this->sales_order_payment_table = $this->getTable("sales_order_payment");
        $this->getSelect()
                ->join(['erp_warehouse' =>'mytek_erp_warehouse'], 'main_table' . '.CODE= erp_warehouse.REF_ARTICLE',
                [
                   '*'
                ]
        );
        $this->getSelect()->where("CODE='".$code."'");
    }


}