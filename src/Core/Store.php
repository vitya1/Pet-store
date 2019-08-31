<?php
namespace Petstore\Core;

use Petstore\Core\Base\Store as BaseStore;
use Petstore\Core\Interfaces\Store as StoreInterface;

/**
 * Class Store
 */
class Store extends BaseStore implements StoreInterface {

    public function getVeterinarRequiredPets(): ?array {
        return array_filter($this->getAllItems(), function($item) {
            return $item->isGoodForChipping();
        });
    }

    public function getDaysOpen(): array {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    }

    public function getShowroomSize(): array {
        return [
            Pet::TYPE_DOG => 5,
            Pet::TYPE_CAT => 10,
            Pet::TYPE_BIRD => 15
        ];
    }

    public function getBackyardSize(): array {
        return [
            Pet::TYPE_DOG => 15,
            Pet::TYPE_CAT => 30,
            Pet::TYPE_BIRD => 30
        ];
    }

}