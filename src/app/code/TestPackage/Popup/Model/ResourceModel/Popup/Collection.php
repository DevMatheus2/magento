<?php declare(strict_types=1);

namespace TestPackage\Popup\Model\ResourceModel\Popup;

use TestPackage\Popup\Model\Popup;
use TestPackage\Popup\Model\ResourceModel\Popup as PopupResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Popup::class,
            PopupResourceModel::class
        );
    }
}