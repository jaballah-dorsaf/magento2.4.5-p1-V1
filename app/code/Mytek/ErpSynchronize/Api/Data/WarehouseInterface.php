<?php
namespace Mytek\ErpSynchronize\Api\Data;

interface WarehouseInterface
{


    /**
     * Return the Depo
     *
     * @return string
     */
    public function getDEPO();

    /**
     * Set the Depo
     *
     * @param string $depo
     * @return $this
     */
    public function setDEPO($depo);
    
    /**
     * Return the QTESTK
     *
     * @return string
     */
    public function getQTESTK();

    /**
     * Set the Quantity 
     *
     * @param string $QTESTK
     * @return $this
     */
    public function setQTESTK($QTESTK);

    /**
     * Return the MSG_ZERO_STK
     *
     * @return string
     */
    public function getMSGZEROSTK();
    
    /**
     * Set the MSG_ZERO_STK
     *
     * @param string $MSG_ZERO_STK
     * @return $this
     */
    public function setMSGZEROSTK($MSG_ZERO_STK);

    /**
     * Return the REF_ARTICLE
     *
     * @return string
     */
    public function getREFARTICLE();

    /**
     * Set the REF_ARTICLE
     *
     * @param string $REF_ARTICLE
     * @return $this
     */
    public function setREFARTICLE($ref_article);

 
}