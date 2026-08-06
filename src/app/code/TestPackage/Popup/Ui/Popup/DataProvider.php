<?php
declare(strict_types=1);

namespace TestPackage\Popup\Ui\Popup;

use TestPackage\Popup\Model\ResourceModel\Popup\CollectionFactory;
use TestPackage\Popup\Model\ResourceModel\Popup\Collection;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    private $loadedData = [];

    /**
     * Undocumented function
     *
     * @param [type] $name
     * @param [type] $primaryFieldName
     * @param [type] $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        ?PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Testpackage\Popup\Model\Popup $popup */
        foreach ($items as $popup) {
            $popupId = $popup->getId();
            if ($popupId !== null) {
                $this->loadedData[$popupId] = $popup->getData();
            }
        }

        $data = $this->dataPersistor->get('testpackage_popup_popup');
        if (!empty($data)) {
            $popup = $this->collection->getNewEmptyItem();
            $popup->setData($data);
            $popupId = $popup->getId();
            if ($popupId !== null) {
                $this->loadedData[$popupId] = $popup->getData();
            }
            $this->dataPersistor->clear('testpackage_popup_popup');
        }

        return $this->loadedData;
    }
}
