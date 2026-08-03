<?php declare(strict_types=1);

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    public function execute() : ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('TestPackage_Popup::popup');
        $page->addBreadcrumb(__('Popups'), __('Popups'));
        $page->addBreadcrumb(__('Novo Popup'), __('Novo Popup'));
        $page->getConfig()->getTitle()->prepend(__('Novo Popup'));

        return $page;
    }
}