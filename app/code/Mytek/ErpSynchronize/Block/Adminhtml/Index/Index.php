<?php

namespace Mytek\ErpSynchronize\Block\Adminhtml\Index;
use Magento\Framework\Data\Form\FormKey;

class Index extends \Magento\Backend\Block\Template
{


    protected $stockRepository;
    protected $array_ws;
    protected $formKey;

	public function __construct
        (
        \Magento\Backend\Block\Template\Context $context,
        \Mytek\ErpSynchronize\Model\StockRepository $stockRepository,
        FormKey $formKey
        
        )
	{
        $this->formKey = $formKey;
		parent::__construct($context);
        $this->stockRepository = $stockRepository;
	}

  

    
    public function getToto($route = '', $params = [])
    {
        // return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getStockBySKU($sku){

        return  $this->stockRepository->getById($sku);
      
    }

    public function setDataWs($array_ws){
                // echo "<pre>----------------";
                // print_r($array_ws);
                // echo "</pre>";
                // exit;
        $this->array_ws =  $array_ws;

    }

    public function getDataWs(){
        return $this->array_ws ;

    }

    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

}