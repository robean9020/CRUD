<?php 
namespace AHT\CRUD\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem; 
use AHT\CRUD\Model\PostFactory;
class Update extends Action
{
     protected $_pageFactory;
     protected $_filesystem;
     protected $_postFactory;
     public function __construct(Context $context,PageFactory $pageFactory,Filesystem $filesystem,PostFactory $postFactory)
     {
          $this->_pageFactory = $pageFactory;
          $this->_filesystem = $filesystem;
          $this->_postFactory = $postFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {        
          $id = $this->getRequest()->getParam('id');
          $data = $this->getRequest()->getPostValue();
          $model = $this->_postFactory->create()->load($id);
          $model->setData('name',$data['name'])
                ->setData('url_key',$data['url_key'])
                ->setData('post_content',$data['post_content'])
                ->setData('tags',$data['tags'])
                ->setData('status',$data['status'])
                ->setData('featured_image',$data['featured_image'])
                ->save();
          return $this->_redirect('crud/index/index');
     }
}