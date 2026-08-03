<?php declare(strict_types=1);

namespace TestPackage\Popup\Service;

use TestPackage\Popup\Api\Data\PopupInterface;
use TestPackage\Popup\Api\PopupRepositoryInterface;
use TestPackage\Popup\Model\PopupFactory;
use TestPackage\Popup\Model\ResourceModel\Popup as PopupResource;

class PopupRepository implements PopupRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param PopupResource $resource
     * @param PopupFactory $factory
     */
    public function __construct(
        private readonly PopupResource $resource,
        private readonly PopupFactory $factory
    
        ) {
    }

    /**
     * Undocumented function
     *
     * @param PopupInterface $popup
     * @return void
     */
    public function save($popup): void
    {
        $this->resource->save($popup);
    }

    /**
     * Undocumented function
     *
     * @param PopupInterface $popup
     * @return void
     */
    public function delete($popup): void
    {
        $this->resource->delete($popup);
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return PopupInterface
     */
    public function getById($id): PopupInterface
    {
        $popup = $this->factory->create();
        $this->resource->load($popup, $id);
        if(!$popup->getId()) {
            throw new NoSuchEntityException(
            __("Popup id '%1' doesn't exist"),
            $id
            );
        }
        return $popup;
    }
}