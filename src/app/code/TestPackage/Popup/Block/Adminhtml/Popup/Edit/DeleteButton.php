<?php
declare(strict_types=1);
namespace TestPackage\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Undocumented function
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getPopupId()) {
            $confirmMessage = $this->getEscaper()->escapeJs(
                $this->getEscaper()->escapeHtml(__('Are you sure you want to do this?'))
            );
            $data = [
                'label' => __('Delete Popup'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . $confirmMessage . '\', \''
                    . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * URL to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['popup_id' => $this->getPopupId()]);
    }
}
