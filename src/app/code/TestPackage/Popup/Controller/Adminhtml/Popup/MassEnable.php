<?php declare(strict_types=1);

namespace TestPackage\Popup\Controller\Adminhtml\Popup;

use TestPackage\Popup\Model\ResourceModel\Popup\CollectionFactory;
use TestPackage\Popup\Api\Data\PopupInterface;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;


class MassEnable extends Action
{
    const ADMIN_RESOURCE = 'TestPackage_Popup::popup';
    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory,
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
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $popup) {
                $popup->setIsActive(PopupInterface::STATUS_ENABLED);
                $this->popupRepository->save($popup);
            }

            $this->messageManager->addSuccessMessage(
                __('Total de registros: %1'),
                $collectionSize
            );

        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(
                __('Ocorreu um erro ao ativar os popups: %1', $exception->getMessage())
            );
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('*/*/');
    }
}