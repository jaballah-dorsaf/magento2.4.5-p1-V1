<?php

namespace Mytek\ErpSynchronize\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Mytek\ErpSynchronize\Model\StockFactory;




class Index extends Action 
{
    const ADMIN_RESOURCE = 'Mytek_ErpSynchronize::post';
    protected $_publicActions = ['index'];
 
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    protected $stockRepository;

    /**
     * @var StockFactory
     */
    protected $stockFactory;
 
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StockFactory $stockFactory,
        \Mytek\ErpSynchronize\Model\StockRepository $stockRepository

    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->stockFactory = $stockFactory;
        $this->stockRepository = $stockRepository;

        // CsrfAwareAction Magento2.3 compatibility
        if (interface_exists("\Magento\Framework\App\CsrfAwareActionInterface")) {
            $request = $this->getRequest();
            if ($request instanceof HttpRequest && $request->isPost() && empty($request->getParam('form_key'))) {
                $formKey = $this->_objectManager->get(\Magento\Framework\Data\Form\FormKey::class);
                $request->setParam('form_key', $formKey->getFormKey());
            }
        }


    }
 
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        // $this->getWarehouses();
        // $sku='82C6006GFE';
        // $this->getStockBySKU($sku);

        // $param1=$this->getRequest()->getParam('order_id');

        // echo "<pre>";
        // print_r($param1);
        // exit;
        
        // $_refarticle= $this->getRequest()->getParam('ref_article');
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mytek_ErpSynchronize::erp_synchronize');
        $resultPage->addBreadcrumb(__('Jobs'), __('Jobs'));
        $resultPage->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));
        $resultPage->getConfig()->getTitle()->prepend(__('Department'));
        
        $_refarticle = $this->getRequest()->getParam('ref_article');
        $ws_action   = $this->getRequest()->getParam('ws_action');
        if(!empty($ws_action) && !empty($_refarticle)){
            // echo "ws_action = ".$ws_action;
            // echo "_refarticle = ".$_refarticle;
            // exit;

            if($ws_action == 'delete'){
                $this->removeStockBySKU($_refarticle);
            }elseif($ws_action == 'filter'){
                $_array_ws= $this->getData($_refarticle);
                // echo "<pre>";
                // print_r($_array_ws);
                // echo "</pre>";
                // exit;


                $resultPage->getLayout()->getBlock('erp_synchronize_index_index')->setDataWs($_array_ws);

            }
        }
        
       
        return $resultPage;
    }


    public function getStockBySKU($sku){

        return  $this->stockRepository->getById($sku);
      
    }

    public function getData($ref_article){

        $_result = $this->getStockBySKU($ref_article);
        $ws_array = $_result->fetchAll();
        return $ws_array;

    }

    public function removeStockBySKU($sku){
        $this->stockRepository->removeById($sku);
    }

   

    protected function _isAllowed()
    {
        // return true;
        return $this->_authorization->isAllowed('Mytek_ErpSynchronize::post');
    }



}