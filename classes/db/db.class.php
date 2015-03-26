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

    public function save($item) {

        $sql = 'INSERT INTO ' . $item->get_storable_table() . ' (' . $item->get_storable_fields() . ') VALUES (' . implode(', ', array_keys($item->get_storable_values())) . ')';

        $query = $this->pdo->prepare($sql);

        if (!$query->execute($item->get_storable_values())) {
#var_dump($query->errorInfo());
            throw new Exception("Error (" . $query->errorInfo()[2] . ") processing save query : " . $sql . ', ' . implode(', ', $item->get_storable_values()));
        }

    }

    public function update($item) {

        $sql = 'UPDATE ' . $item->get_storable_table() . ' SET ';
        dump($sql);

    }

    public function delete($table = '', $id) {

    }

}
