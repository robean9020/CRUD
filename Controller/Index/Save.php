<?php 
namespace AHT\CRUD\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem; 
use AHT\CRUD\Model\PostFactory; 

class Save extends Action
{
     protected $_pageFactory;
     protected $_postFactory;
     protected $_dataFactory;
     public function __construct(Context $context,PageFactory $pageFactory,Filesystem $filesystem,postFactory $postFactory)
     {
          $this->_pageFactory = $pageFactory;
          $this->_filesystem = $filesystem;
          $this->_postFactory = $postFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {        
          $model = $this->_postFactory->create();
          $data = $this->getRequest()->getPostValue();
          unset($data['form_key']);
          $model->addData($data);
          // $model->setId();
          $model->save();
          return $this->_redirect('crud/index/index');
     }
}