<?php declare(strict_types=1);

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use TestPackage\Popup\Api\Data\PopupInterfaceFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Request\DataPersistorInterface;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'TestPackage_Popup::popup';
    public function __construct(
        Context $context,
        private readonly PopupRepositoryInterface $popupRepository,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly PopupInterfaceFactory $popupFactory
    ) {
        parent::__construct($context);
    }
    public function execute() : ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $popupId = $this->getRequest()->getParam('popup_id');

        if($popupId) {
            try {
                $popup = $this->popupRepository->getById((int)$popupId);
                $this->dataPersistor->set('testpackage_popup_popup', $popup->getData());
            } catch (NoSuchEntityException $e) {
                //$this->messageManager->addErrorMessage(__('Popup not found.'));
                //return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
        } else {
            $popup = $this->popupFactory->create();
        }



        $title = $popup->getPopupId() ? $popup->getName() : __('New Popup');
        $label = $title;


        $page->setActiveMenu('TestPackage_Popup::popup');
        $page->addBreadcrumb(__('Popups'), __('Popups'));
        $page->addBreadcrumb($title, $label);
        $page->getConfig()->getTitle()->prepend($title);

        return $page;
    }
}