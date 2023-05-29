<?php
namespace Mytek\ErpSynchronize\Api\Data;

interface StockInterface
{


    /**
     * Return the Code
     *
     * @return string
     */
    public function getCODE();

    /**
     * Set the Customer Name
     *
     * @param string $code
     * @return $this
     */
    public function setCODE($code);

    /**
     * Return the Price
     *
     * @return string
     */
    public function getPRIX();

    /**
     * Set the Prix
     *
     * @param string $prix
     * @return $this
     */
    public function setPRIX($prix);
    

    /**
     * Return the PRIX_SPECIFIQUE
     *
     * @return string
     */
    public function getPRIXSPECIFIQUE();

    /**
     * Set the PRIX_SPECIFIQUE
     *
     * @param string $PRIX_SPECIFIQUE
     * @return $this
     */
    public function setPRIXSPECIFIQUE($PRIX_SPECIFIQUE);

    /**
     * Return the CODE_BARRES
     *
     * @return string
     */
    public function getCODEBARRES();

  
    /**
     * Set the CODE_BARRES
     *
     * @param string $CODE_BARRES
     * @return $this
     */
    public function setCODEBARRES($CODE_BARRES);

    /**
     * Return the FAMILLE
     *
     * @return string
     */
    public function getFAMILLE();

    /**
     * Set the FAMILLE
     *
     * @param string $FAMILLE
     * @return $this
     */
    public function setFAMILLE($FAMILLE);

    /**
     * Return the DES
     *
     * @return string
     */
    public function getDES();

    /**
     * Set the DES
     *
     * @param string $DES
     * @return $this
     */
    public function setDES($DES);

    /**
     * Return the _6MOIS
     *
     * @return string
     */
    public function get6MOIS();

    /**
     * Set the _6MOIS
     *
     * @param string $_6MOIS
     * @return $this
     */
    public function set6MOIS($_6MOIS);
   
   
    /**
     * Return the _3MOIS
     *
     * @return string
     */
    public function get3MOIS();

    /**
     * Set the _3MOIS
     *
     * @param string $_3MOIS
     * @return $this
     */
    public function set3MOIS($_3MOIS);


    /**
     * Return the _9MOIS
     *
     * @return string
     */
    public function get9MOIS();

    /**
     * Set the _9MOIS
     *
     * @param string $_9MOIS
     * @return $this
     */
    public function set9MOIS($_9MOIS);

    /**
     * Return the _12MOIS
     *
     * @return string
     */
    public function get12MOIS();


    /**
     * Set the _12MOIS
     *
     * @param string $_12MOIS
     * @return $this
     */
    public function set12MOIS($_12MOIS);

    /**
     * Return the UPDATED_DATE
     *
     * @return int
     */
    public function getUPDATEDDATE();

    /**
     * Set the UPDATED_DATE
     *
     * @param string $UPDATED_DATE
     * @return $this
     */
    public function setUPDATEDDATE($UPDATED_DATE);

    /**
     * @return \Mytek\ErpSynchronize\Api\Data\WarehouseInterface[]
     */
    public function getWarehouses();
 
    /**
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface[] $warehouses
     * @return void
     */
    public function setWarehouses(array $warehouses);
 
}