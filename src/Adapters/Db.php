<?php
namespace Petstore\Adapters;

use Petstore\Framework\DataStorage;
use Petstore\Core\{Payment, Pet};

/**
 * Adapter for Petstore\Framework\DataStorage.php
 */
class Db {

    /**
     * @return array
     */
    public function findItems() {
        return $this->find(Pet::getTableName(), Pet::class);
    }

    /**
     * @return array
     */
    public function findPayments() {
        return $this->find(Payment::getTableName(), Payment::class);
    }

    /**
     * @param string $table_name
     * @param string $class
     * @return array
     */
    public function find($table_name, $class) {
        $storage = new DataStorage();
        $data = $storage->findAll($table_name);
        $result = [];
        if(!$data) {
            return $result;
        }
        foreach($data as $item_data) {
            $result[] = new $class($item_data);
        }
        return $result;
    }

    /**
     * @param string $table_name
     * @param array $data
     */
    public function save($table_name, $data) {
        $storage = new DataStorage();
        $storage->saveNew($table_name, $data);
    }

}
