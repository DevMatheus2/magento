<?php declare(strict_types=1);

namespace Testpackage\Popup\Controller\Adminhtml\Popup;

use TestPackage\Popup\Model\ResourceModel\Popup\CollectionFactory;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;

class InlineEdit extends Action
{
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
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items = $this->getRequest()->getParam('items');

        $messages = [];
        $error = false;

        if(!count($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        } else {
            foreach (array_keys($items) as $popupId) {
                $popup = $this->popupRepository->getById((int)$popupId);
                try {
                    $popup->setData(array_merge($popup->getData(), $items[$popupId]));
                    $this->popupRepository->save($popup);
                } catch (\Throwable $exception) {
                    $messages[] = "[Popup ID: {$popupId}]  {$exception->getMessage()}";
                    $error = true;
                }
            }
        }

        return $result->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}