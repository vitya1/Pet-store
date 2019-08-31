<?php
namespace Petstore\Core\Base;

use Petstore\Adapters\Db;

/**
 * Base AR class
 */
abstract class Model {

    /**
     * @return String
     */
    abstract public static function getTableName(): String;

    /**
     * Fill model with data.
     * @param Array $data
     */
    public function __construct(array $data = []) {
        if(!empty($data)) {
            foreach($data as $property => $value) {
                if(!property_exists(static::class, $property)) {
                    continue;
                }
                $this->$property = $value;
            }
        }
    }

    /**
     * Save model
     */
    public function save() {
        $props = get_object_vars($this);
        $db = new Db();
        $db->save(static::getTableName(), $props);
    }

}
