<?php
    require_once 'framework/core/DBConnection.class.php';

    abstract class BaseActiveRecord {
        protected $tableName = '';
        protected $fields = [];
        protected $fieldsWithValues = [];

        function __construct($values) {
            foreach($this->fields as $field) {
                if (isset($values[$field]))
                $this->fieldsWithValues[$field] = $values[$field];
            }
        }

        public function updateValue($field, $value) {
            $this->fieldsWithValues[$field] = $value;
        }

        public function save() {
            $dbConnection = DBConnection::getInstance();
            $queryStr = isset($this->fieldsWithValues['id'])
                ? $this->getUpdateQuery()
                : $this->getInsertQuery();
            $query = $dbConnection->dbh->prepare($queryStr);
            $query->execute();
        }

        private function getInsertQuery() {
            $result = [
                'keys' => '',
                'values' => ''
            ];

            foreach($this->fieldsWithValues as $key => $value) {
                if (strlen($result['keys']) == 0) {
                    $result['keys'] = $key;
                    $result['values'] = $this->prepareValueFroDB($value);
                } else {
                    $result['keys'] = $result['keys'] . ', ' . $key;
                    $result['values'] = $result['values'] . ', ' . $this->prepareValueFroDB($value);
                }
            }

            return 'INSERT INTO ' . $this->tableName . '(' . $result['keys'] . ') VALUES(' . $result['values'] . ')';
        }

        private function getUpdateQuery() {
            $setters = '';
            foreach($this->fieldsWithValues as $key => $value) {
                if (strlen($setters) == 0) {
                    $setters = $setters . $key . '=' . $this->prepareValueFroDB($value);
                } else {
                    $setters = $setters . ', ' . $key . '=' . $this->prepareValueFroDB($value);
                }
            }

            return 'UPDATE ' . $this->tableName . ' set ' . $setters . ' where id=' . $this->fieldsWithValues['id'];
        }

        private function prepareValueFroDB($value) {
            if (is_string($value)) {
                return '"' . $value . '"';
            }
            if (is_array($value)) {
                return "'" . json_encode($value) . "'";
            }

            return $value;
        }

        public static function getRecords($offset, $limit, $order) {
            $dbConnection = DBConnection::getInstance();
            $queryStr = 'SELECT * from ' . static::$table;
            if (isset($order['field'])) {
                $direction = isset($order['direction']) ? $order['direction'] : 'asc';
                $queryStr = $queryStr . ' order by ' . $order['field'] . ' ' . $direction;
            }
            $queryStr = $queryStr . ' limit ' . $offset . ', ' . $limit;
            $query = $dbConnection->dbh->prepare($queryStr);
            $query->execute();
            $records = $query->fetchAll();
            $mapper = function($rec) {
                return new static($rec);
            };
            return array_map($mapper, $records);
        }
        
        public static function getRecordsCount() {
            $dbConnection = DBConnection::getInstance();
            $query = $dbConnection->dbh->prepare('select count(*) from ' . static::$table);
            $query->execute();
            return (int)$query->fetchColumn();
        }

        public function get() {
            return $this->fieldsWithValues;
        }

        public function delete() {
            if (isset($this->fieldsWithValues['id'])) {
                $dbConnection = DBConnection::getInstance();
                $query = $dbConnection->dbh->prepare('DELETE from ' . $this->tableName . ' where id=' . $this->fieldsWithValues['id']);
                $query->execute();
                return true;
            }
            return false;
        }

        // TO DO
        // public static function updateWhere($values, $condition) {}
        // public static function findByID($id) {}
        // public static function find($condition) {}
        // public static function deleteByCond($condition) {}
    }
?>