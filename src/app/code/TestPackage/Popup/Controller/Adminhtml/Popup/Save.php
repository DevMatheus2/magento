<?php

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use TestPackage\Popup\Api\Data\PopupInterface;
use TestPackage\Popup\Api\Data\PopupInterfaceFactory;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;


class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'TestPackage_Popup::popup';
    /**
     * Undocumented function
     *
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param PopupInterfaceFactory $popupFactory
     * @param PopupRepositoryInterface $popupRepository
     */
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly PopupInterfaceFactory $popupFactory,
        private readonly PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = PopupInterface::STATUS_ENABLED;
            }
            if (empty($data['popup_id'])) {
                $data['popup_id'] = null;
            }

            $model = $this->popupFactory->create();

            $id = (int) $this->getRequest()->getParam('popup_id');
            if ($id) {
                try {
                    $model = $this->popupRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->popupRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the popup.'));
                $this->dataPersistor->clear('testpackage_popup_popup');
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the popup.'));
            }

            $this->dataPersistor->set('testpackage_popup_popup', $data);
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
