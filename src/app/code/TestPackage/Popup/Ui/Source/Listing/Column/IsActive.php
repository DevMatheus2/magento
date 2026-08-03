<?php declare(strict_types=1);

namespace TestPackage\Popup\Ui\Source\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface 
{
    private const ENABLED = 1;
    private const DISABLED = 0;

    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::ENABLED,
                'label' => 'Habilitado',
            ],
            [
                'value' => self::DISABLED,
                'label' => 'Desabilitado',
            ],
        ];
    }
}