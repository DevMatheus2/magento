<?php declare(strict_types=1);

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;


class NewAction extends Action
{
    const ADMIN_RESOURCE = 'TestPackage_Popup::popup';
    public function execute(): ResultInterface
    {
       return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)
        ->forward('edit');
    }
}