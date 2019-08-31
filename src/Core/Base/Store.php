<?php
namespace Petstore\Core\Base;

use Petstore\Adapters\Db;

/**
 * 
 */
abstract class Store {
    protected $items = [];

    /**
     * @return array
     */
    abstract public function getShowRoomSize(): array;
    /**
     * @return array
     */
    abstract public function getBackyardSize(): array;
    /**
     * @return array
     */
    abstract public function getDaysOpen(): array;

    /**
     * @inheritdoc
     */
    public function getAllItems(): ?array {
        //@todo DI
        if(!$this->items) {
            $db = new Db();
            $this->items = $db->findItems();
        }
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function getAllPayments($filter_params = []): ?array {
        $db = new Db();
        return $db->findPayments($filter_params);
    }

    /**
     * @inheritdoc
     */
    public function moveAllToBackyard(): void {
        $items = array_filter($this->getAllItems(), function($item) {
            return $item->location == BaseItem::LOCATION_SHOWROOM;
        });
        foreach($items as $item) {
            $item->location = BaseItem::LOCATION_BACKYARD;
            $item->save();
        }
    }

}