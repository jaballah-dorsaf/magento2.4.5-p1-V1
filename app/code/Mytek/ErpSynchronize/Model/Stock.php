<?php

namespace Mytek\ErpSynchronize\Model;

use Mytek\ErpSynchronize\Api\Data\StockInterface;

class Stock extends \Magento\Framework\Model\AbstractModel implements \Mytek\ErpSynchronize\Api\Data\StockInterface
{

    // const CACHE_TAG = 'mytek_stock';

    protected function _construct()
    {
        $this->_init('Mytek\ErpSynchronize\Model\ResourceModel\Stock');
    }

    // public function getIdentities()
	// {
	// 	return [self::CACHE_TAG . '_' . $this->getId()];
	// }

    /**
     * @inheritdoc
     */
    public function getCODE()
    {
        return $this->_getData('CODE');
    }

    /**
     * @inheritdoc
     */
    public function setCODE($code)
    {
        $this->setData('CODE', $code);
    }

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
    public function getPRIX()
    {
        return $this->_getData('PRIX');
    }

    /**
     * @inheritdoc
     */
    public function setPRIX($prix)
    {
        $this->setData('PRIX', $prix);
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
    public function getPRIXSPECIFIQUE()
    {
        return $this->_getData('PRIX_SPECIFIQUE');
    }

    /**
     * @inheritdoc
     */
    public function setPRIXSPECIFIQUE($prix_specifique)
    {
        $this->setData('PRIX_SPECIFIQUE', $prix_specifique);
    }

    /**
     * @inheritdoc
     */
    public function getCODEBARRES()
    {
        return $this->_getData('CODE_BARRES');
    }

    /**
     * @inheritdoc
     */
    public function setCODEBARRES($code_barres)
    {
        $this->setData('CODE_BARRES', $code_barres);
    }


    /**
     * @inheritdoc
     */
    public function getFAMILLE()
    {
        return $this->_getData('FAMILLE');
    }

    /**
     * @inheritdoc
     */
    public function setFAMILLE($famille)
    {
        $this->setData('FAMILLE', $famille);
    }


    /**
     * @inheritdoc
     */
    public function getDES()
    {
        return $this->_getData('DES');
    }

    /**
     * @inheritdoc
     */
    public function setDES($des)
    {
        $this->setData('DES', $des);
    }

    /**
     * @inheritdoc
     */
    public function get3MOIS()
    {
        return $this->_getData('_3MOIS');
    }

    /**
     * @inheritdoc
     */
    public function set3MOIS($_3mois)
    {
        $this->setData('_3MOIS', $_3mois);
    }


    /**
     * @inheritdoc
     */
    public function get6MOIS()
    {
        return $this->_getData('_6MOIS');
    }

    /**
     * @inheritdoc
     */
    public function set6MOIS($_6mois)
    {
        $this->setData('_6MOIS', $_6mois);
    }




    /**
     * @inheritdoc
     */
    public function get9MOIS()
    {
        return $this->_getData('_9MOIS');
    }

    /**
     * @inheritdoc
     */
    public function set9MOIS($_9mois)
    {
        $this->setData('_9MOIS', $_9mois);
    }

        /**
     * @inheritdoc
     */
    public function get12MOIS()
    {
        return $this->_getData('_12MOIS');
    }

    /**
     * @inheritdoc
     */
    public function set12MOIS($_12mois)
    {
        $this->setData('_12MOIS', $_12mois);
    }


    /**
     * @inheritdoc
     */
    public function getUPDATEDDATE(){
        return $this->_getData('UPDATED_DATE');
    }


    /**
     * @inheritdoc
     */
    public function setUPDATEDDATE($UPDATED_DATE){
        $this->setData('UPDATED_DATE', $UPDATED_DATE);
    }
  
    /**
     * @inheritdoc
     */
    public function getWarehouses(){
        return $this->_getData('wharehouses');
    }
 
    /**
     * @inheritdoc
     */
    public function setWarehouses(array $warehouse){
        $this->setData('wharehouses', $warehouse);

    }


}