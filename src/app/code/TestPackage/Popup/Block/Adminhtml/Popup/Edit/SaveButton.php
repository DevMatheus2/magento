<?php
declare(strict_types=1);
namespace TestPackage\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'testpackage_popup_form.testpackage_popup_form',
                                'actionName' => 'save',
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
