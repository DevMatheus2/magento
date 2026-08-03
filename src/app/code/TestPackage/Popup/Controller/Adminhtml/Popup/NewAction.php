<?php declare(strict_types=1);

namespace Testpackage\Popup\Controller\Adminhtml\Popup;

use TestPackage\Popup\Model\ResourceModel\Popup\CollectionFactory;
use TestPackage\Popup\Api\Data\PopupInterface;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;


class NewAction extends Action
{
    public function execute(): ResultInterface
    {
       return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)
        ->forward('edit');
    }
}