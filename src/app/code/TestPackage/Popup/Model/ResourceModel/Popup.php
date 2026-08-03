<?php declare(strict_types=1);

namespace TestPackage\Popup\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;

class Popup extends AbstractDb
{
    private const TABLE_NAME = 'testpackage_popup';
    private const PRIMARY_KEY = 'popup_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }

    protected function _beforeSave(AbstractModel $object)
    {
        $object->setData('updated_at', 0);
        return parent::_beforeSave($object);
    }
}