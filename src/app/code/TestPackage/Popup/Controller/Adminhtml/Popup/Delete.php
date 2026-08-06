<?php declare(strict_types=1);

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use TestPackage\Popup\Model\ResourceModel\Popup\CollectionFactory;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;


class Delete extends Action
{
    const ADMIN_RESOURCE = 'TestPackage_Popup::popup';
    public function __construct(
        Context $context,
        private readonly PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Undocumented function
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $popupId = (int) $this->getRequest()->getParam('popup_id',0);

            $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            if(!$popupId) {
                $this->messageManager->addWarningMessage(
                    __('Não foi possível encontrar o recurso.')
                );
                return $result->setPath('*/*/');
            }

            $popup = $this->popupRepository->getById($popupId);

            if(!$popupId) {
                $this->messageManager->addWarningMessage(
                    __('Não foi possível encontrar o recurso.')
                );
                return $result->setPath('*/*/');
            }

            $this->popupRepository->delete($popup);

            $this->messageManager->addSuccessMessage(
                __('Registro deletado com sucesso: %1', $popupId)
            );

        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(
                __('Ocorreu um erro ao deletar o popup: %1', $exception->getMessage())
            );
        }

        return $result->setPath('*/*/');
    }
}