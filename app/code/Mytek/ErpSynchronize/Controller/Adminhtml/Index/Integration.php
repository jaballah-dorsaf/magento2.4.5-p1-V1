<?php

namespace Mytek\ErpSynchronize\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Mytek\ErpSynchronize\Model\StockFactory;




class Integration extends Action 
{
    const ADMIN_RESOURCE = 'Mytek_ErpSynchronize::integration';
    protected $_publicActions = ['integration'];
 
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
        // echo "new tab";
        // exit;
        
        // $_refarticle= $this->getRequest()->getParam('ref_article');
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mytek_ErpSynchronize::erp_synchronize');
        $resultPage->addBreadcrumb(__('Jobs'), __('Jobs'));
        $resultPage->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));
        $resultPage->getConfig()->getTitle()->prepend(__('Update product'));
        
        $_refarticle = $this->getRequest()->getParam('ref_article');
        $short_description   = $this->getRequest()->getParam('short_description');
        if(!empty($short_description) && !empty($_refarticle)){
            // echo "short_description = ".$short_description;
            // echo "_refarticle = ".$_refarticle;
            // exit;

           
                $this->stockRepository->updateShortDescription($_refarticle, $short_description);
            

                // $resultPage->getLayout()->getBlock('erp_synchronize_index_index')->setDataWs($_array_ws);

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
        return $this->_authorization->isAllowed('Mytek_ErpSynchronize::integration');
    }



}