<?php
namespace AHT\CRUD\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('post', 'post_id');
    }
}