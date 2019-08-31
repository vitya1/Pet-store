<?php
namespace Petstore\Framework;

/**
 * Simple data provider. Was made specificly for this task.
 * Must be replaced with something else in a real project.
 * Doesn't actually use a database. Stores data in the JSON files.
 */
class DataStorage {

    /**
     * @param string $table_name
     * @return array
     */
    public function findAll($table_name) {
        $data = file_get_contents(__DIR__.'/../../data/'.$table_name.'.json');
        return json_decode($data, true);
    }

    /**
     * @param string $table_name
     * @param array $data
     */
    public function saveNew($table_name, $data) {
        $filename = __DIR__.'/../../data/'.$table_name.'.json';
        $str = file_get_contents($filename);
        $array = json_decode($str, true);
        $array[] = $data;
        $str = file_put_contents($filename, json_encode($array));
    }

}