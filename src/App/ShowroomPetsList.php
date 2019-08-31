<?php

namespace Petstore\App;

use Petstore\Core\Store;
use Petstore\Core\Pet;
use Petstore\App\Interfaces\UseCase as UseCaseInterface;

/**
 * Class ShowroomPetsList
 * Gives a list of pets that should be in the showroom.
 */
class ShowroomPetsList implements UseCaseInterface {

    public function handle() {
        $out = 'Pets that should be in the showroom:'."\n";
        $pet_list = $this->getPetList();
        foreach($pet_list as $item) {
            $out .= $item->name.' ('.$item->type.'), '.$item->description."\n";
        }
        return $out;
    }

    public function getPetList() {
        $store = $this->createStoreInstance();
        $items = $store->getAllItems();

        //@todo it would be better to filter with query
        $result = array_filter($items, function($item) {
            /** Pet $item */
            return $item->isPresentable();
        });

        return $result;
    }

    //@todo replace with DI
    public function createStoreInstance() {
        return new Store();
    }
}
