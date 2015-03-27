<?php

class db extends db_orm {

    private $pdo = NULL;

    public function __construct(array $db_data) {

        try {
            $this->pdo = new PDO("mysql:dbname=" . $db_data['dbname'] . ";host=" . $db_data['host'], $db_data['user'], $db_data['password']);
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            dump($e, 'PDO Exception');
        }

    }

    /**
     * Gets Db entries and returns as array
     *
     * @param string $table Table name
     * @param string $fields Fields
     * @param array $where Where conditions array
     * @param array $group Group by conditions array
     * @param array $order Order by conditions array
     * @return array
     */
    public function get($table = '', $fields = '', $where = array(), $group = array(), $order = array()) {

        if (empty($fields)) {
            $fields = '*';
        }

        $sql = 'SELECT ' . $fields . ' FROM ' . $table ;

        foreach (array('where', 'group', 'order') AS $value) {

            if (!empty($$value)) {
                $sql .= ' ' . strtoupper($value) . ' ' . implode($$value, ' AND ');
            }

        }

        $query = $this->pdo->prepare($sql);
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);

        return $res;

    }

    /**
     * Gets Db entries list and returns array of objects
     *
     * @param string $table Table name
     * @param string $fields Fields
     * @param array $where Where conditions array
     * @param array $group Group by conditions array
     * @param array $order Order by conditions array
     * @return array
     */
    public function get_all($classname, $where = array(), $group = array(), $order = array()) {

        $data = $this->get($classname, '*', $where, $group, $order);

        foreach ($data AS $key => $item_data) {
            dump();
        }

    }

    /**
     * Gets Db entry and returns as array
     *
     * @param string $table Table name
     * @param int $id Row entry id
     * @return array
     */
    public function get_value($table = '', $id) {

        check_int($id, 'id');

        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $table . '_id = ' . $id;

        $query = $this->pdo->prepare($sql);

        try {
            $query->execute();
        } catch(PDOException $PDOException) {
            dump($PDOException->getMessage());
        }

        $res = $query->fetch(PDO::FETCH_ASSOC);

        if (!$res) {
            return array();
        } else {
            return $res;
        }

    }

    /**
     * Saves item in db
     *
     * @param object $item
     * @return void
     */
    public function save($item) {

        $sql = 'INSERT INTO ' . $item->get_storable_table() . ' (' . $item->get_storable_fields() . ') VALUES (' . implode(', ', array_keys($item->get_storable_values())) . ')';

        $query = $this->pdo->prepare($sql);

        if (!$query->execute($item->get_storable_values())) {
#var_dump($query->errorInfo());
            throw new Exception("Error (" . $query->errorInfo()[2] . ") processing save query : " . $sql . ', ' . implode(', ', $item->get_storable_values()));
        }

        $item->load((int)$this->pdo->lastInsertId());

    }

    /**
     * Updates item in db
     *
     * @param object $item
     * @return void
     */
    public function update($item) {

        $data = array();
        $class_name = get_class($item);

        foreach ($item->get_storable_values() AS $key => $value) {
            $data[] = substr($key, 1) . ' = ' . $key;
        }

        $sql = 'UPDATE ' . $item->get_storable_table() . ' SET ' . implode(', ', $data) . ' WHERE ' . $class_name . '_id = :' . $class_name . '_id';

        $query = $this->pdo->prepare($sql);

        if (!$query->execute($item->get_storable_values())) {
#var_dump($query->errorInfo());
            throw new Exception("Error (" . $query->errorInfo()[2] . ") processing update query : " . $sql . ', ' . implode(', ', $item->get_storable_values()));
        }

    }

    /**
     * Deletes item in db
     *
     * @param object $item
     * @return void
     */
    public function delete($item) {

        $class_name = get_class($item);

        $sql = 'DELETE FROM ' . $class_name .  ' WHERE ' . $class_name . '_id = ' . $item->get_id();

        $query = $this->pdo->prepare($sql);

        if (!$query->execute()) {
#var_dump($query->errorInfo());
            throw new Exception("Error (" . $query->errorInfo()[2] . ") processing delete query : " . $sql . ', ' . implode(', ', $item->get_storable_values()));
        }

    }

}
