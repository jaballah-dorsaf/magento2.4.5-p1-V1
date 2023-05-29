<?php

namespace Mytek\ErpSynchronize\Model;

use Mytek\ErpSynchronize\Api\Data\WarehouseInterface;

class Warehouse extends \Magento\Framework\Model\AbstractModel implements
    \Mytek\ErpSynchronize\Api\Data\WarehouseInterface
{
    protected function _construct()
    {
        $this->_init('Mytek\ErpSynchronize\Model\ResourceModel\Warehouse');
    }


    // /**
    //  * @inheritdoc
    //  */
    // public function getID(){
    //     return $this->_getID('ID');

    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function setID($id){
    //     $this->setData('ID', $id);
    // }


    /**
     * @inheritdoc
     */
    public function getDEPO()
    {
        return $this->_getData('DEPO');
    }

    /**
     * @inheritdoc
     */
    public function setDEPO($depo)
    {
        $this->setData('DEPO', $depo);
    }


    /**
     * @inheritdoc
     */
    public function getQTESTK()
    {
        return $this->_getData('QTESTK');
    }

    /**
     * @inheritdoc
     */
    public function setQTESTK($qtestk)
    {
        $this->setData('QTESTK', $qtestk);
    }

    /**
     * @inheritdoc
     */
    public function getMSGZEROSTK()
    {
        return $this->_getData('MSG_ZERO_STK');
    }

    /**
     * @inheritdoc
     */
    public function setMSGZEROSTK($msg_zero_stk)
    {
        $this->setData('MSG_ZERO_STK', $msg_zero_stk);
    }

    /**
     * @inheritdoc
     */
    public function getREFARTICLE()
    {
        return $this->_getData('REF_ARTICLE');
    }

    /**
     * @inheritdoc
     */
    public function setREFARTICLE($ref_article)
    {
        $this->setData('REF_ARTICLE', $ref_article);
    }



}